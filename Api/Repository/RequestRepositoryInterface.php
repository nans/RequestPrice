<?php

namespace Nans\RequestPrice\Api\Repository;

use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\NoSuchEntityException;
use Nans\RequestPrice\Api\Data\RequestInterface;

interface RequestRepositoryInterface
{
    /**
     * @param RequestInterface $request
     *
     * @return void
     * @throws CouldNotDeleteException
     * @throws NoSuchEntityException
     */
    public function delete(RequestInterface $request);

    /**
     * @param int $id
     *
     * @return void
     * @throws NoSuchEntityException
     * @throws CouldNotDeleteException
     */
    public function deleteById(int $id);

    /**
     * @param int $id
     *
     * @return RequestInterface
     * @throws NoSuchEntityException
     */
    public function getById(int $id): RequestInterface;

    /**
     * @param RequestInterface $request
     *
     * @return RequestInterface
     * @throws CouldNotSaveException
     */
    public function save(RequestInterface $request): RequestInterface;

    /**
     * @param array $data
     *
     * @return RequestInterface
     */
    public function create(array $data = []): RequestInterface;
}