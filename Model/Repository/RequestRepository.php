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
    protected $instances = [];

    /**
     * @var ResourceRequest
     */
    protected $resource;

    /**
     * @var RequestFactory
     */
    protected $factory;

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
        $this->resource = $resource;
        $this->factory = $factory;
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
            unset($this->instances[$id]);
            $this->resource->delete($request);
        } catch (Exception $e) {
            throw new CouldNotDeleteException(__($e->getMessage()));
        }
        unset($this->instances[$id]);
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

        if (!isset($this->instances[$id])) {
            /** @var RequestInterface|AbstractModel $request */
            $request = $this->factory->create();
            $this->resource->load($request, $id);
            if (!$request->getId()) {
                throw new NoSuchEntityException();
            }
            $this->instances[$id] = $request;
        }

        return $this->instances[$id];
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
            $this->resource->save($request);
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
        return $this->factory->create(['data' => $data]);
    }
}