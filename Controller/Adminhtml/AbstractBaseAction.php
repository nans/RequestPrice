<?php

namespace Nans\RequestPrice\Controller\Adminhtml;

use Magento\Framework\Registry;
use Magento\Backend\App\Action;
use Magento\Framework\View\Result\PageFactory;
use Nans\RequestPrice\Api\Repository\RequestRepositoryInterface;
use Magento\Backend\Model\Session;

abstract class AbstractBaseAction extends Action
{
    /**
     * @var RequestRepositoryInterface
     */
    protected $requestRepository;

    /**
     * @var Registry
     */
    protected $registry;

    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * @var Session
     */
    protected $session;

    /**
     * AbstractBaseAction constructor.
     * @param Action\Context $context
     * @param RequestRepositoryInterface $requestRepository
     * @param Registry $registry
     * @param PageFactory $resultPageFactory
     * @param Session $session
     */
    public function __construct(
        Action\Context $context,
        RequestRepositoryInterface $requestRepository,
        Registry $registry,
        PageFactory $resultPageFactory,
        Session $session
    ) {
        parent::__construct($context);
        $this->requestRepository = $requestRepository;
        $this->registry = $registry;
        $this->resultPageFactory = $resultPageFactory;
        $this->session = $session;
    }

    /**
     * @return boolean
     */
    protected function _isAllowed(): bool
    {
        return $this->_authorization->isAllowed($this->_getACLName());
    }

    /**
     * @return string
     */
    abstract protected function _getACLName(): string;
}