<?php

namespace TGM\Voodoo\Helper;

class Data extends \Magento\Framework\App\Helper\AbstractHelper
{
    protected $platform         = 'Magento';
    protected $platformVersion  = '2.0';
    protected $format           = 'json';
    protected $host             = 'http://www.voodoosms.com/';

    /**
     * Getting Basic Configuration
     * These functions are used to get the api username and password
    */

    //Getting VoodooSMS API Username
    public function getVoodooApiUsername(){
        return $this->getConfig('tgm_voodoo_configuration/basic_configuration/voodoo_username');
    }

    //Getting VoodooSMS API Password
    public function getVoodooApiPassword(){
        return $this->getConfig('tgm_voodoo_configuration/basic_configuration/voodoo_password');
    }

    /**
     * Getting Admin Configuration
     * These functions are used to get the admin mobile number and notification enable or not
     */

    //Checking Admin SMS is enabled or not
    public function isAdminNotificationsEnabled(){
        return $this->getConfig('tgm_voodoo_admins/admin_configuration/voodoo_admin_enabled');
    }

    //Getting Admin Mobile Number
    public function getAdminSenderId(){
        return $this->getConfig('tgm_voodoo_admins/admin_configuration/voodoo_admin_mobile');
    }

    //Getting Admin message for new order
    public function getAdminMessageForNewOrder(){
        return $this->getConfig('tgm_voodoo_admins/admin_configuration/voodoo_new_order_admin_message');
    }

    //Getting Admin message for order Hold
    public function getAdminMessageForOrderHold(){
        return $this->getConfig('tgm_voodoo_admins/admin_configuration/voodoo_hold_admin_message');
    }

    //Getting Admin message for order unhold
    public function getAdminMessageForOrderUnHold(){
        return $this->getConfig('tgm_voodoo_admins/admin_configuration/voodoo_unhold_admin_message');
    }

    //Getting Admin message for order cancelled
    public function getAdminMessageForOrderCancelled(){
        return $this->getConfig('tgm_voodoo_admins/admin_configuration/voodoo_cancelled_admin_message');
    }

    //Getting Admin message for Invoiced
    public function getAdminMessageForInvoiced(){
        return $this->getConfig('tgm_voodoo_admins/admin_configuration/voodoo_invoiced_admin_message');
    }

    //Getting Admin message for Signup
    public function getAdminMessageForRegister(){
        return $this->getConfig('tgm_voodoo_admins/admin_configuration/voodoo_register_admin_message');
    }


    /**
     * Getting Customer Configuration
     * These functions are used to get the customer information when new order is placed
     */

    //Checking Customer SMS is enabled or not
    public function isCustomerNotificationsEnabledOnOrder(){
        return $this->getConfig('tgm_voodoo_orders/new_order/voodoo_new_order_enabled');
    }

    //Getting Customer Sender ID
    public function getCustomerSenderId(){
        return $this->getConfig('tgm_voodoo_orders/new_order/voodoo_new_order_sender_id');
    }

    //Getting Customer Message
    public function getCustomerMessageOnOrder(){
        return $this->getConfig('tgm_voodoo_orders/new_order/voodoo_new_order_message');
    }

    /**
     * Getting Customer Configuration
     * These functions are used to get the customer information when order is on hold
     */

    //Checking Customer SMS is enabled or not
    public function isCustomerNotificationsEnabledOnHold(){
        return $this->getConfig('tgm_voodoo_orders/hold_order/voodoo_hold_order_enabled');
    }

    //Getting Customer Sender ID
    public function getCustomerSenderIdonHold(){
        return $this->getConfig('tgm_voodoo_orders/hold_order/voodoo_hold_order_sender_id');
    }

    //Getting Customer Message
    public function getCustomerMessageOnHold(){
        return $this->getConfig('tgm_voodoo_orders/hold_order/voodoo_hold_order_message');
    }

    /**
     * Getting Customer Configuration
     * These functions are used to get the customer information when order is on un hold
     */

    //Checking Customer SMS is enabled or not
    public function isCustomerNotificationsEnabledOnUnHold(){
        return $this->getConfig('tgm_voodoo_orders/unhold_order/voodoo_unhold_order_enabled');
    }

    //Getting Customer Sender ID
    public function getCustomerSenderIdonUnHold(){
        return $this->getConfig('tgm_voodoo_orders/unhold_order/voodoo_unhold_order_sender_id');
    }

    //Getting Customer Message
    public function getCustomerMessageOnUnHold(){
        return $this->getConfig('tgm_voodoo_orders/unhold_order/voodoo_unhold_order_message');
    }

    /**
     * Getting Customer Configuration
     * These functions are used to get the customer information when order is Cancelled
     */

    //Checking Customer SMS is enabled or not
    public function isCustomerNotificationsEnabledOnCancelled(){
        return $this->getConfig('tgm_voodoo_orders/cancelled_order/voodoo_cancelled_order_enabled');
    }

    //Getting Customer Sender ID
    public function getCustomerSenderIdonCancelled(){
        return $this->getConfig('tgm_voodoo_orders/cancelled_order/voodoo_cancelled_order_sender_id');
    }

    //Getting Customer Message
    public function getCustomerMessageOnCancelled(){
        return $this->getConfig('tgm_voodoo_orders/cancelled_order/voodoo_cancelled_order_message');
    }

    /**
     * Getting Customer Configuration
     * These functions are used to get the customer information when invoice is created
     */

    //Checking Customer SMS is enabled or not
    public function isCustomerNotificationsEnabledOnInvoiced(){
        return $this->getConfig('tgm_voodoo_orders/invoiced_order/voodoo_invoiced_order_enabled');
    }

    //Getting Customer Sender ID
    public function getCustomerSenderIdonInvoiced(){
        return $this->getConfig('tgm_voodoo_orders/invoiced_order/voodoo_invoiced_order_sender_id');
    }

    //Getting Customer Message
    public function getCustomerMessageOnInvoiced(){
        return $this->getConfig('tgm_voodoo_orders/invoiced_order/voodoo_invoiced_order_message');
    }

    /**
     * The Basics:
     * These functions are used to do the basic functionality
     */

    //Send Configuration path to this function and get the module admin Config data
    public function getConfig($config_path)
    {
        return $this->scopeConfig->getValue(
            $config_path,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }

    //Curl Function to get the result from VoodooSMS API
    public function curl($url){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $url);
        $data = curl_exec($ch);
        curl_close($ch);
        return $data;
    }

    //Verification of API Account
    public function verifyApi($username,$password){
        $host       = $this->host;
        $path       = "vapi/server/getCredit";
        $data       = '?uid='.urlencode($username).
                      '&pass='.urlencode($password);
        $format     = '&format='.$this->format;
        $url        = $host.$path.$data.$format;
        $verified   = $this->curl($url);
        $verified   = json_decode($verified);
        if(isset($verified->credit)){
            return  true;
        }
        return      false;
    }

    //Sending SMS
    public function sendSms($username,$password,$senderID,$destination,$message){
        $host       = $this->host;
        $path       = 'vapi/server/sendSMS?';
        $data       = 'uid='.urlencode($username).
                      '&pass='.urlencode($password).
                      '&dest='.urlencode($destination).
                      '&orig='.urlencode($senderID).
                      '&msg='.urlencode($message).
                      '&validity=300';
        $format     = '&format='.$this->format;
        $platform   = '&platform='.$this->platform.
                      '&platform_version='.$this->platformVersion;
        $url        = $host.$path.$data.$format.$platform;
        $this->curl($url);
    }

    //Getting Credits
    public function getCredit($username,$password){
        $host       = $this->host;
        $path       = "vapi/server/getCredit";
        $data       = '?uid='.urlencode($username).
                      '&pass='.urlencode($password);
        $format     = '&format='.$this->format;
        $url        = $host.$path.$data.$format;
        $verified   = $this->curl($url);
        $verified   = json_decode($verified);
        if(isset($verified->credit)){
            return  number_format($verified->credit,2);
        }
        return      false;
    }

    //Insert Admin Config Values in the message using order data
    public function manipulateSMS($message,$data){
        $keywords   = array(
            '{order_id}',
            '{firstname}',
            '{middlename}',
            '{lastname}',
            '{dob}',
            '{email}',
            '{price}',
            '{cc}',
            '{gender}',
            '{pc}'
        );
        $message            = str_replace($keywords,$data,$message);
        return $message;
    }

    /**
     * The Fetchers
     * These functions are used to fetch the details using observer
     */

    //Getting Products
    public function getProduct(\Magento\Framework\Event\Observer $observer)
    {
        $product_id         = $observer->getProduct()->getId();
        $objectManager      = \Magento\Framework\App\ObjectManager::getInstance();
        $product            = $objectManager->get('Magento\Catalog\Model\Product')->load($product_id);
        return $product;
    }

    //Getting Order Details
    public function getOrder(\Magento\Framework\Event\Observer $observer)
    {
        $order              = $observer->getOrder();
        $order_id           = $order->getIncrementId();
        $objectManager      = \Magento\Framework\App\ObjectManager::getInstance();
        $order              = $objectManager->get('Magento\Sales\Model\Order');
        $order_information  = $order->loadByIncrementId($order_id);
        return $order_information;
    }
}