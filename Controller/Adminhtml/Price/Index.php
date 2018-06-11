<?php

namespace Nans\RequestPrice\Controller\Adminhtml\Price;

use Magento\Backend\Model\View\Result\Page;
use Magento\Backend\Model\View\Result\Page as ResultPage;
use Nans\RequestPrice\Helper\Acl;
use Nans\RequestPrice\Controller\Adminhtml\AbstractBaseAction;

class Index extends AbstractBaseAction
{
    /**
     * @return ResultPage
     */
    public function execute()
    {
        /** @var ResultPage $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $this->_setResultPageParams($resultPage);
        return $resultPage;
    }

    /**
     * @param ResultPage $resultPage
     */
    protected function _setResultPageParams(Page &$resultPage)
    {
        $resultPage->addBreadcrumb(__('Request Price'), __('Request Price'));
        $resultPage->addBreadcrumb(__('Manage'), __('Manage'));
        $resultPage->getConfig()->getTitle()->prepend(__('Request Price'));
    }

    /**
     * @return string
     */
    protected function _getACLName(): string
    {
        return Acl::ACL_REQUEST_VIEW;
    }
}