<?php

namespace Nans\RequestPrice\Model\Request;

use Magento\Framework\Exception\NotFoundException;
use Magento\Framework\Model\AbstractModel;
use Magento\Framework\Registry;
use Magento\Ui\DataProvider\AbstractDataProvider;
use Magento\Framework\App\RequestInterface as HttpRequestInterface;
use Nans\RequestPrice\Api\Data\RequestInterface;
use Nans\RequestPrice\Api\Repository\RequestRepositoryInterface;
use Nans\RequestPrice\Model\ResourceModel\Request\Collection;
use Nans\RequestPrice\Model\ResourceModel\Request\CollectionFactory;

class DataProvider extends AbstractDataProvider
{
    /**
     * @var Collection
     */
    protected $collection;

    /**
     * @var array
     */
    protected $loadedData;

    /**
     * @var RequestRepositoryInterface
     */
    private $requestRepository;

    /**
     * @var Registry
     */
    private $registry;

    /**
     * @var HttpRequestInterface
     */
    private $request;

    /**
     * @param $name
     * @param $primaryFieldName
     * @param $requestFieldName
     * @param RequestRepositoryInterface $requestRepository
     * @param CollectionFactory $collectionFactory
     * @param Registry $registry
     * @param HttpRequestInterface $request
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        RequestRepositoryInterface $requestRepository,
        CollectionFactory $collectionFactory,
        Registry $registry,
        HttpRequestInterface $request,
        array $meta = [],
        array $data = []
    ) {
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
        $this->collection = $collectionFactory->create();
        $this->requestRepository = $requestRepository;
        $this->registry = $registry;
        $this->request = $request;
    }

    /**
     * @return array
     * @throws NotFoundException
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getData(): array
    {
        if (isset($this->loadedData)) {

            return $this->loadedData;
        }

        /** @var RequestInterface|AbstractModel $request */
        $request = $this->getCurrentRequest();
        $this->loadedData[$request->getId()] = $request->toArray();

        return $this->loadedData;
    }

    /**
     * @return RequestInterface
     * @throws NotFoundException
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getCurrentRequest(): RequestInterface
    {
        /** @var RequestInterface|AbstractModel $request */
        $request = $this->registry->registry('request_price');
        if ($request && $request->getId()) {

            return $request;
        }

        $params = $this->request->getParams();
        if (!is_array($params) || !key_exists('id', $params)) {
            throw new NotFoundException(__('Data not found'));
        }

        $request = $this->requestRepository->getById($params['id']);

        return $request;
    }
}
