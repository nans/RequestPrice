<?php

namespace Nans\RequestPrice\Model\Repository;

use Exception;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Model\AbstractModel;
use Nans\RequestPrice\Api\Data\RequestInterface;
use Nans\RequestPrice\Api\Repository\RequestRepositoryInterface;
use Nans\RequestPrice\Model\ResourceModel\Request as ResourceRequest;
use Nans\RequestPrice\Model\RequestFactory;

class RequestRepository implements RequestRepositoryInterface
{
    /**
     * @var array
     */
    protected $_instances = [];

    /**
     * @var ResourceRequest
     */
    protected $_resource;

    /**
     * @var RequestFactory
     */
    protected $_factory;

    /**
     * Factory constructor
     * @param ResourceRequest $resource ,
     * @param RequestFactory $factory
     */
    public function __construct(
        ResourceRequest $resource,
        RequestFactory $factory
    )
    {
        $this->_resource = $resource;
        $this->_factory = $factory;
    }

    /**
     * @param RequestInterface $request
     *
     * @return void
     * @throws CouldNotDeleteException
     * @throws NoSuchEntityException
     */
    public function delete(RequestInterface $request)
    {
        /** @var RequestInterface|AbstractModel $request */
        $id = $request->getId();
        if (!$id) {
            throw new NoSuchEntityException();
        }

        try {
            unset($this->_instances[$id]);
            $this->_resource->delete($request);
        } catch (Exception $e) {
            throw new CouldNotDeleteException(__($e->getMessage()));
        }
        unset($this->_instances[$id]);
    }

    /**
     * @param int $id
     *
     * @return void
     * @throws NoSuchEntityException
     * @throws CouldNotDeleteException
     */
    public function deleteById(int $id)
    {
        $this->delete($this->getById($id));
    }

    /**
     * @param int $id
     *
     * @return RequestInterface
     * @throws NoSuchEntityException
     */
    public function getById(int $id): RequestInterface
    {
        if (!$id) {
            throw new NoSuchEntityException();
        }

        if (!isset($this->_instances[$id])) {
            /** @var RequestInterface|AbstractModel $request */
            $request = $this->_factory->create();
            $this->_resource->load($request, $id);
            if (!$request->getId()) {
                throw new NoSuchEntityException();
            }
            $this->_instances[$id] = $request;
        }
        return $this->_instances[$id];
    }

    /**
     * @param RequestInterface $request
     *
     * @return RequestInterface
     * @throws CouldNotSaveException
     */
    public function save(RequestInterface $request): RequestInterface
    {
        /** @var RequestInterface|AbstractModel $request */
        try {
            $this->_resource->save($request);
        } catch (Exception $exception) {
            throw new CouldNotSaveException(__('Could not save the record: %1', $exception->getMessage()));
        }
        return $request;
    }

    /**
     * @param array $data
     *
     * @return RequestInterface
     */
    public function create(array $data = []): RequestInterface
    {
        return $this->_factory->create(['data' => $data]);
    }
}