<?php

namespace Nans\RequestPrice\Controller\Adminhtml\Price;

use Magento\Backend\Model\View\Result\Page;
use Magento\Backend\Model\View\Result\Redirect;
use Magento\Framework\Model\AbstractModel;
use Nans\RequestPrice\Api\Data\RequestInterface;
use Nans\RequestPrice\Controller\Adminhtml\AbstractBaseAction;
use Nans\RequestPrice\Helper\Acl;

class Edit extends AbstractBaseAction
{
    /**
     * Edit record data
     *
     * @return Page|Redirect
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function execute()
    {
        $id = $this->getRequest()->getParam('id');

        /** @var RequestInterface|AbstractModel $model */
        if ($id) {
            $model =  $this->requestRepository->getById($id);
            if (!$model->getId()) {
                $this->messageManager->addErrorMessage(__('This record no longer exists.'));
                /** @var Redirect $resultRedirect */
                $resultRedirect = $this->resultRedirectFactory->create();
                return $resultRedirect->setPath('*/*/');
            }
        } else {
            $model = $this->requestRepository->create();
        }

        $data = $this->session->getFormData(true);
        if (!empty($data)) {
            $model->setData($data);
        }

        $this->registry->register($this->_getRegisterName(), $model);

        /** @var Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        return $this->_initAction($resultPage, $model);
    }

    /**
     * @return string
     */
    protected function _getACLName(): string
    {
        return Acl::ACL_REQUEST_EDIT;
    }

    /**
     * @return string
     */
    protected function _getRegisterName(): string
    {
        return 'request_price';
    }

    /**
     * @param Page $resultPage
     * @param RequestInterface $model
     * @return Page
     */
    protected function _initAction(Page $resultPage, RequestInterface $model)
    {
        $id = $model->getId();
        $resultPage
            ->addBreadcrumb(__('Request'), __('Request'))
            ->addBreadcrumb(__('Manage'), __('Manage'));
        $resultPage->addBreadcrumb(
            $id ? __('Edit') : __('New'),
            $id ? __('Edit') : __('New')
        );
        $resultPage->getConfig()->getTitle()->prepend(__('Request'));
        $resultPage->getConfig()->getTitle()->prepend(
            $model->getId() ? $model->getName() : __('New request')
        );

        return $resultPage;
    }
}