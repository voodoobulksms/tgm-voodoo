<?php

namespace TGM\Voodoo\Observer;

use Magento\Framework\Event\ObserverInterface;

/**
 * Customer login observer
 */
class InvoicePay implements ObserverInterface
{
    /**
     * Message manager
     *
     * @var \Magento\Framework\Message\ManagerInterface
     */
    const AJAX_PARAM_NAME       = 'infscroll';
    const AJAX_HANDLE_NAME      = 'infscroll_ajax_request';

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
        $this->_helper          = $helper;
        $this->_request         = $context->getRequest();
        $this->_layout          = $context->getLayout();
    }

    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        /**
         * Getting Module Configuration from admin panel
         */

        //Getting Username
        $this->username         = $this->_helper->getVoodooApiUsername();

        //Getting Password
        $this->password         = $this->_helper->getVoodooApiPassword();

        //Getting Sender ID
        $this->sender_id        = $this->_helper->getCustomerSenderIdonInvoiced();

        //Getting Message
        $this->message          = $this->_helper->getCustomerMessageOnInvoiced();

        //Getting Customer Notification value
        $this->enabled          = $this->_helper->isCustomerNotificationsEnabledOnInvoiced();

        //Checking if sms is enable or not
        if($this->enabled==1){

            /**
             * Verification of API Account
             */

            //Verification of API
            $verificationResult     = $this->_helper->verifyApi($this->username,$this->password);
            if($verificationResult  == true){
                //Getting Order Details
                $invoice            = $observer->getInvoice();
                $order              =   $invoice->getOrder($invoice);
                $orderData          =   array(
                    'orderId'       =>  $order->getIncrementId(),
                    'firstname'     =>  $order->getCustomerFirstname(),
                    '$middlename'   =>  $order->getCustomerMiddlename(),
                    'lastname'      =>  $order->getCustomerLastname(),
                    'totalPrice'    =>  number_format($order->getGrandTotal(),2),
                    'countryCode'   =>  $order->getOrderCurrencyCode(),
                    'protectCode'   =>  $order->getProtectCode(),
                    'customerDob'   =>  $order->getCustomerDob(),
                    'customerEmail' =>  $order->getCustomerEmail(),
                    'gender'        => ($order->getCustomerGender()?'Female':'Male'),
                );
                //Getting Telephone Number
                $this->destination  = $order->getBillingAddress()->getTelephone();

                //Manipulating SMS
                $this->message      = $this->_helper->manipulateSMS($this->message,$orderData);

                //Sending SMS
                $this->_helper->sendSms($this->username,$this->password,$this->sender_id,$this->destination,$this->message);

                //Sending SMS to Admin
                if($this->_helper->isAdminNotificationsEnabled()==1){
                    $this->destination  = $this->_helper->getAdminSenderId();
                    $this->message      = $this->_helper->getAdminMessageForInvoiced();
                    $this->message      = $this->_helper->manipulateSMS($this->message,$orderData);
                    $this->_helper->sendSms($this->username,$this->password,$this->sender_id,$this->destination,$this->message);
                }
            }
        }


    }
}