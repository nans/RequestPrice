<?php

namespace Nans\RequestPrice\Controller\Adminhtml\Price;

use Magento\Backend\Model\View\Result\Redirect;
use Magento\Framework\Model\AbstractModel;
use Nans\RequestPrice\Api\Data\RequestInterface;
use Nans\RequestPrice\Controller\Adminhtml\AbstractBaseAction;
use Nans\RequestPrice\Helper\Acl;

class Save extends AbstractBaseAction
{
    public function execute()
    {
        $data = $this->getRequest()->getParams();

        /** @var Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();

        if ($data) {
            /** @var RequestInterface|AbstractModel $model */
            $model = $this->requestRepository->create();

            $id = $this->getRequest()->getParam($this->_getIdFieldName());
            if ($id) {
                $model = $this->requestRepository->getById($id);
            }

            $model->setData($data);

            try {
                $this->requestRepository->save($model);
                $this->messageManager->addSuccessMessage(__('Changes was saved.'));
                $this->session->setFormData(false);
                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath(
                        '*/*/edit',
                        ['id' => $model->getId(),
                            '_current' => true]
                    );
                }
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                $this->messageManager->addExceptionMessage(
                    $e, __('Something went wrong while saving data.')
                );
            }
            $this->_getSession()->setFormData($data);
            return $resultRedirect->setPath(
                '*/*/edit',
                ['id' => $this->getRequest()->getParam($this->_getIdFieldName())]
            );
        }

        return $resultRedirect->setPath('*/*/');
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
    protected function _getIdFieldName(): string
    {
        return RequestInterface::KEY_ID;
    }
}