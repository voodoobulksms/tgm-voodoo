<?php

namespace TGM\Voodoo\Observer;

use Magento\Framework\Event\ObserverInterface;

/**
 * Customer login observer
 */
class OrderCreate implements ObserverInterface
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
        \TGM\Voodoo\Helper\Data $helper){
        $this->_helper = $helper;
        $this->_request = $context->getRequest();
        $this->_layout = $context->getLayout();
    }
    /*
        /**
         * Display a custom message when customer log in
         *
         * @param  \Magento\Framework\Event\Observer $observer Observer
         *
         * @return $order_information
         */

    public function getOrder(\Magento\Framework\Event\Observer $observer)
    {


        $order = $observer->getOrder();
        $order_id = $order->getIncrementId();
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $order = $objectManager->get('Magento\Sales\Model\Order');
        $order_information = $order->loadByIncrementId($order_id);
        return $order_information;
    }

    public function getProduct(\Magento\Framework\Event\Observer $observer)
    {

        $product_id = $observer->getProduct()->getId();
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $product = $objectManager->get('Magento\Catalog\Model\Product')->load($product_id);
        return $product;


    }
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        /**
         * Getting Module Configuration from admin panel
         */

        //Getting Username
        $this->username     = $this->_helper->getVoodooApiUsername();

        //Getting Password
        $this->password     = $this->_helper->getVoodooApiPassword();

        //Getting Sender ID
        $this->sender_id    = $this->_helper->getCustomerSenderId();

        //Getting Message
        $this->message      = $this->_helper->getCustomerMessageOnOrder();

        //Getting Customer Notification value
        $this->enabled      = $this->_helper->isCustomerNotificationsEnabledOnOrder();

        /**
         * Verification of API Account
         */

        //Verification of API
        $verificationResult = $this->_helper->verifyApi($this->username,$this->password);
        if($verificationResult == true){

            //Getting Order Details
            $order = $this->getOrder($observer);
            echo '<pre>';print_r($order->getIncrementId());echo '</pre>';die('Call');
            $orderData = array(
                'firstname'     => $order->getCustomerFirstname(),
                '$middlename'   => $order->getCustomerMiddlename(),
                'lastname'      => $order->getCustomerLastname(),
                'totalPrice'    => $order->getGrandTotal(),
                'countryCode'   => $order->getOrderCurrencyCode(),
                'protectCode'   => $order->getProtectCode(),
                'customerDob'   => $order->getCustomerDob(),
                'customerEmail' => $order->getCustomerEmail(),
                'gender'        => $order->getCustomerGender(),
                'telephone'     => $order->getBillingAddress()->getTelephone(),
            );
            echo '<pre>';print_r($orderData);echo '</pre>';die('Call');

            //Manipulating SMS
            //$finalMessage = $this->_helper->manipulateSMS($this->message,$orderData);

            //Sending SMS
            //$this->_helper->sendSms($this->username,$this->password,$this->sender_id,$orderData['telephone'],$finalMessage);
        }







    }

}