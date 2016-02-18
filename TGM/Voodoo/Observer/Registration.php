<?php

namespace TGM\Voodoo\Observer;

use Magento\Framework\Event\ObserverInterface;

/**
 * Customer login observer
 */
class Registration implements ObserverInterface
{
    /**
     * Message manager
     *
     * @var \Magento\Framework\Message\ManagerInterface
     */
    const AJAX_PARAM_NAME = 'infscroll';
    const AJAX_HANDLE_NAME = 'infscroll_ajax_request';
    /**
     * Https request
     *
     * @var \Zend\Http\Request
     */
    protected $_request;
    protected $_layout;
    protected $_cache;
    protected $messageManager;
    protected $username;
    protected $password;
    protected $sender_id;
    protected $destination;
    protected $message;
    protected $enabled;

    /**
     * Constructor
     *
     * @param \TGM\Voodoo\Helper\Data $helper _helper
     *
     * @return void
     */

    public function __construct(
        \Magento\Framework\View\Element\Context $context,
        \TGM\Voodoo\Helper\Data $helper)
    {
        $this->_helper = $helper;
        $this->_request = $context->getRequest();
        $this->_layout = $context->getLayout();
    }

    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        /**
         * Getting Module Configuration from admin panel
         */

        //Getting Username
        $this->username = $this->_helper->getVoodooApiUsername();

        //Getting Password
        $this->password = $this->_helper->getVoodooApiPassword();

        /**
         * Verification of API Account
         */

        //Verification of API
        $verificationResult = $this->_helper->verifyApi($this->username, $this->password);
        if ($verificationResult == true) {
            //Getting Order Details
            $event = $observer->getEvent();
            $customer = array(
                'id'=>$event->getCustomer()->getId(),
                'createdAt'=>$event->getCustomer()->getCreatedAt(),
                'email'=>$event->getCustomer()->getEmail(),
                'firstName'=>$event->getCustomer()->getFirstname(),
                'lastName'=>$event->getCustomer()->getLastname(),
            );

            //Sending SMS to Admin
            if ($this->_helper->isAdminNotificationsEnabled() == 1) {
                $this->sender_id = "Your Magento";
                $this->destination = $this->_helper->getAdminSenderId();
                $this->message = $this->_helper->getAdminMessageForRegister();
                $keywords = array('{customer_id}','{created_at}','{email}','{firstname}','{lastname}');
                $this->message = str_replace($keywords,$customer,$this->message);
                $this->_helper->sendSms($this->username, $this->password, $this->sender_id, $this->destination, $this->message);
            }
        }
    }
}