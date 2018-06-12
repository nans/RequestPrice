<?php

namespace Nans\RequestPrice\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class AddHandles implements ObserverInterface
{
    /**
     * @param Observer $observer
     */
    public function execute(Observer $observer)
    {
        $layout = $observer->getEvent()->getLayout();
        $layout->getUpdate()->addHandle('customer_request_price');
    }
}