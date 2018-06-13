<?php

namespace Nans\RequestPrice\Model;

use Magento\Framework\App\Request\Http;
use Nans\RequestPrice\Api\Data\RequestApiInterface;
use Nans\RequestPrice\Api\Data\RequestInterface;
use Nans\RequestPrice\Api\Repository\RequestRepositoryInterface;

class RequestApi implements RequestApiInterface
{
    /** @var Http */
    protected $request;

    /**
     * @var RequestRepositoryInterface
     */
    private $requestRepository;

    /**
     * @param Http $request
     * @param RequestRepositoryInterface $requestRepository
     */
    public function __construct(
        Http $request,
        RequestRepositoryInterface $requestRepository
    ) {
        $this->request = $request;
        $this->requestRepository = $requestRepository;
    }

    /**
     * @param string $email
     * @param string $name
     * @param string $comment
     * @param string $sku
     * @return string
     */
    public function makeRequest(string $email, string $name, string $comment, string $sku): string
    {
        try {
            /** @var RequestInterface $request */
            $request = $this->requestRepository->create();
            $request->setSku($sku);
            $request->setComment($comment);
            $request->setName($name);
            $request->setEmail($email);
            $this->requestRepository->save($request);
        } catch (\Exception $exception) {
            return json_encode(['success' => false, 'message' => __('Request has not been sent')]);
        }
        return json_encode(['success' => true, 'message' => __('Request has been sent')]);
    }
}