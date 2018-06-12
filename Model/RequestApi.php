<?php

namespace Nans\RequestPrice\Model;

use Nans\RequestPrice\Api\Data\RequestApiInterface;
use Magento\Framework\App\Request\Http;
use Nans\RequestPrice\Api\Data\RequestInterface;
use Nans\RequestPrice\Api\Repository\RequestRepositoryInterface;

class RequestApi implements RequestApiInterface
{
    /** @var Http  */
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
     * @return array
     */
    public function makeRequest(): array
    {
        $params = $this->request->getParams();
        $email = $this->request->getParam(RequestInterface::KEY_EMAIL);
        $name = $this->request->getParam(RequestInterface::KEY_NAME);
        $comment = $this->request->getParam(RequestInterface::KEY_COMMENT);

        return [['result' => true]];
    }
}