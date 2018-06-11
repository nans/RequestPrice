<?php

namespace Nans\RequestPrice\Controller\Adminhtml\Price;

use Magento\Backend\Model\View\Result\Redirect;
use Magento\Framework\Controller\ResultInterface;
use Nans\RequestPrice\Controller\Adminhtml\AbstractBaseAction;
use Nans\RequestPrice\Helper\Acl;

class Delete extends AbstractBaseAction
{
    /**
     * @return ResultInterface
     */
    public function execute()
    {
        $id = $this->getRequest()->getParam('id');
        /** @var Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($id) {
            try {
                $this->_deleteRecordById($id);
                $this->messageManager->addSuccessMessage(__('The record has been deleted.'));
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
                return $resultRedirect->setPath('*/*/edit', ['id' => $id]);
            }
        }
        $this->messageManager->addErrorMessage(__('We can\'t find a record to delete.'));
        return $resultRedirect->setPath('*/*/');
    }

    /**
     * @param int $id
     *
     * @return void
     */
    protected function _deleteRecordById(int $id)
    {
        $this->requestRepository->deleteById($id);
    }

    /**
     * @return string
     */
    protected function _getACLName(): string
    {
        return Acl::ACL_REQUEST_DELETE;
    }
}