<?php

namespace Nans\RequestPrice\Controller\Adminhtml\Price;

use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\Forward;
use Magento\Framework\Controller\Result\ForwardFactory;
use Magento\Backend\Model\Session;
use Magento\Framework\Registry;
use Magento\Framework\View\Result\PageFactory;
use Nans\RequestPrice\Api\Repository\RequestRepositoryInterface;
use Nans\RequestPrice\Controller\Adminhtml\AbstractBaseAction;
use Nans\RequestPrice\Helper\Acl;

class NewAction extends AbstractBaseAction
{
    /**
     * @var Forward
     */
    protected $resultForwardFactory;

    /**
     * @param Context $context
     * @param ForwardFactory $resultForwardFactory
     * @param RequestRepositoryInterface $requestRepository
     * @param Registry $registry
     * @param PageFactory $resultPageFactory
     * @param Session $session
     */
    public function __construct(
        Context $context,
        ForwardFactory $resultForwardFactory,
        RequestRepositoryInterface $requestRepository,
        Registry $registry,
        PageFactory $resultPageFactory,
        Session $session
    ) {
        $this->resultForwardFactory = $resultForwardFactory;
        parent::__construct($context, $requestRepository, $registry, $resultPageFactory, $session);
    }

    /**
     * @return Forward
     */
    public function execute()
    {
        /** @var Forward $resultForward */
        $resultForward = $this->resultForwardFactory->create();
        return $resultForward->forward('edit');
    }

    /**
     * @return string
     */
    protected function _getACLName(): string
    {
        return Acl::ACL_REQUEST_EDIT;
    }
}
