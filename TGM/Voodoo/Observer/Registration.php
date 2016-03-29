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
    /**
     *
     */
    const AJAX_HANDLE_NAME = 'infscroll_ajax_request';

    /**
     * Https request
     *
     * @var \Zend\Http\Request
     */
    protected $_request;

    /**
     * Layout Interface
     * @var \Magento\Framework\View\LayoutInterface
     */
    protected $_layout;

    /**
     * Cache
     * @var $_cache
     */
    protected $_cache;

    /**
     * Helper for VoodooSMS Module
     * @var \TGM\Voodoo\Helper\Data
     */
    protected $_helper;

    /**
     * Message Manager
     * @var $messageManager
     */
    protected $messageManager;

    /**
     * Username
     * @var $username
     */
    protected $username;

    /**
     * Password
     * @var $password
     */
    protected $password;

    /**
     * Sender ID
     * @var $senderId
     */
    protected $senderId;

    /**
     * Destination
     * @var $destination
     */
    protected $destination;

    /**
     * Message
     * @var $message
     */
    protected $message;

    /**
     * Whether Enabled or not
     * @var $enabled
     */
    protected $enabled;

    /**
     * Constructor
     * @param \Magento\Framework\View\Element\Context $context
     * @param \TGM\Voodoo\Helper\Data $helper _helper
     */
    public function __construct(
        \Magento\Framework\View\Element\Context $context,
        \TGM\Voodoo\Helper\Data $helper
    ) {
        $this->_helper = $helper;
        $this->_request = $context->getRequest();
        $this->_layout = $context->getLayout();
    }

    /**
     * The execute class
     * @param \Magento\Framework\Event\Observer $observer
     * @return void
     */
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
            $customer = [
                'id'=>$event->getCustomer()->getId(),
                'createdAt'=>$event->getCustomer()->getCreatedAt(),
                'email'=>$event->getCustomer()->getEmail(),
                'firstName'=>$event->getCustomer()->getFirstname(),
                'lastName'=>$event->getCustomer()->getLastname()
            ];
            //Sending SMS to Admin
            if ($this->_helper->isAdminNotificationsEnabled() == 1) {
                $this->senderId = "Your Magento";
                $this->destination = $this->_helper->getAdminSenderId();
                $this->message = $this->_helper->getAdminMessageForRegister();
                $keywords = ['{customer_id}','{created_at}','{email}','{firstname}','{lastname}'];
                $this->message = str_replace($keywords, $customer, $this->message);
                $this->_helper->sendSms(
                    $this->username,
                    $this->password,
                    $this->senderId,
                    $this->destination,
                    $this->message
                );
            }
        }
    }
}