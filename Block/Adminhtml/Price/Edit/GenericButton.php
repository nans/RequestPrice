<?php

namespace Nans\RequestPrice\Block\Adminhtml\Price\Edit;

use Magento\Backend\Block\Widget\Context;
use Magento\Framework\Exception\NotFoundException;
use Magento\Framework\Registry;
use Magento\Framework\UrlInterface;

class GenericButton
{
    /**
     * @var UrlInterface
     */
    protected $urlBuilder;

    /**
     * @var Registry
     */
    protected $registry;

    /**
     * @param Context $context
     * @param Registry $registry
     */
    public function __construct(
        Context $context,
        Registry $registry
    )
    {
        $this->urlBuilder = $context->getUrlBuilder();
        $this->registry = $registry;
    }

    /**
     * @return int
     * @throws NotFoundException
     */
    public function getRequestId(): int
    {
        $request = $this->registry->registry('request_price');
        if (!$request->getId()) {
            throw new NotFoundException(__('Record not found'));
        }
        return $request->getId();
    }

    /**
     * Generate url by route and parameters
     *
     * @param   string $route
     * @param   array $params
     * @return  string
     */
    public function getUrl($route = '', $params = []): string
    {
        return $this->urlBuilder->getUrl($route, $params);
    }

    /**
     * Check where button can be rendered
     *
     * @param string $name
     * @return string
     */
    public function canRender($name): string
    {
        return $name;
    }
}
