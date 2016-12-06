<?php

namespace Training\Helloworld\Observers;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Psr\Log\LoggerInterface;

class PredispatchLogUrl implements ObserverInterface {

    protected $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function execute(Observer $observer)
    {
        $this->logger->debug($observer->getEvent()->getRequest()->getPathInfo());
    }

}