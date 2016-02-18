<?php

namespace TGM\Voodoo\Observer;

use Magento\Framework\Event\ObserverInterface;

/**
 * Customer login observer
 */
class Login implements ObserverInterface
{

    /**
     * Message manager
     *
     * @var \Magento\Framework\Message\ManagerInterface
     */
    protected $messageManager;
    protected $_helper;

    /**
     * Constructor
     *
     * @param  \Magento\Framework\Message\ManagerInterface $messageManager Message Manager
     *
     * @return void
     */
    public function __construct(\TGM\Voodoo\Helper\Data $helper,
        \Magento\Framework\Message\ManagerInterface $messageManager
    ) {
        $this->messageManager = $messageManager;
        $this->_helper = $helper;
    }

    /**
     * Display a custom message when customer log in
     *
     * @param  \Magento\Framework\Event\Observer $observer Observer
     *
     * @return void
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        echo $this->_helper->getVoodooApiUsername().'<br/>';
        die('Call');
        $event    = $observer->getEvent();
        $order = $event->getCustomer();
        echo '<pre>';print_r($order);echo '</pre>';die('Call');
        //$this->messageManager->addNotice(__('Welcome back %1!', $customer->getName()));
    }



}