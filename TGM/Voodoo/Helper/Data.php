<?php

namespace TGM\Voodoo\Helper;

use \Magento\Framework\App\ObjectManager as ObjectManager;
use \Magento\Framework\Event\Observer as Observer;
use \Magento\Store\Model\ScopeInterface as ScopeInterface;
use \Magento\Framework\App\Helper\AbstractHelper as AbstractHelper;

class Data extends AbstractHelper
{
    /**
     * This will used by voodoo sms admins to confirm which e-commerce platform is sending sms
     * @var string
     */
    protected $_platform         = 'Magento';
    /**
     * The version of e-commerce platform
     * @var string
     */
    protected $_platformVersion  = '2.0';
    /**
     * Return type of api method
     * @var string
     */
    protected $_format           = 'json';
    /**
     * To be used by the API
     * @var string
     */
    protected $_host             = 'https://www.voodoosms.com/';

    /**
     * Getting Basic Configuration
     * These functions are used to get the api username and password
     */

    /**
     * Getting VoodooSMS API Username
     * @return string
     */
    public function getVoodooApiUsername()
    {
        return $this->getConfig('tgm_voodoo_configuration/basic_configuration/voodoo_username');
    }

    /**
     * Getting VoodooSMS API Password
     * @return string
     */
    public function getVoodooApiPassword()
    {
        return $this->getConfig('tgm_voodoo_configuration/basic_configuration/voodoo_password');
    }


    /**
     * Checking Admin SMS is enabled or not
     * @return string
     */
    public function isAdminNotificationsEnabled()
    {
        return $this->getConfig('tgm_voodoo_admins/admin_configuration/voodoo_admin_enabled');
    }

    /**
     * Getting Admin Mobile Number
     * @return string
     */
    public function getAdminSenderId()
    {
        return $this->getConfig('tgm_voodoo_admins/admin_configuration/voodoo_admin_mobile');
    }

    /**
     * Getting admin message for new order
     * @return string
     */
    public function getAdminMessageForNewOrder()
    {
        return $this->getConfig('tgm_voodoo_admins/admin_configuration/voodoo_new_order_admin_message');
    }

    /**
     * Getting Admin message for order Hold
     * @return string
     */
    public function getAdminMessageForOrderHold()
    {
        return $this->getConfig('tgm_voodoo_admins/admin_configuration/voodoo_hold_admin_message');
    }

    /**
     * Getting Admin message for order unhold
     * @return string
     */
    public function getAdminMessageForOrderUnHold()
    {
        return $this->getConfig('tgm_voodoo_admins/admin_configuration/voodoo_unhold_admin_message');
    }

    /**
     * Getting Admin message for order cancelled
     * @return string
     */
    public function getAdminMessageForOrderCancelled()
    {
        return $this->getConfig('tgm_voodoo_admins/admin_configuration/voodoo_cancelled_admin_message');
    }

    /**
     * Getting Admin message for Invoiced
     * @return string
     */
    public function getAdminMessageForInvoiced()
    {
        return $this->getConfig('tgm_voodoo_admins/admin_configuration/voodoo_invoiced_admin_message');
    }


    /**
     * Getting Admin message for Sign up
     * @return string
     */
    public function getAdminMessageForRegister()
    {
        return $this->getConfig('tgm_voodoo_admins/admin_configuration/voodoo_register_admin_message');
    }


    /**
     * Getting Customer Configuration
     * These functions are used to get the customer information when new order is placed
     */

    /**
     * Checking Customer SMS is enabled or not
     * @return string
     */
    public function isCustomerNotificationsEnabledOnOrder()
    {
        return $this->getConfig('tgm_voodoo_orders/new_order/voodoo_new_order_enabled');
    }

    /**
     * Getting Customer Sender ID
     * @return string
     */
    public function getCustomerSenderId()
    {
        return $this->getConfig('tgm_voodoo_orders/new_order/voodoo_new_order_sender_id');
    }

    /**
     * Getting Customer Message
     * @return string
     */
    public function getCustomerMessageOnOrder()
    {
        return $this->getConfig('tgm_voodoo_orders/new_order/voodoo_new_order_message');
    }

    /**
     * Getting Customer Configuration
     * These functions are used to get the customer information when order is on hold
     */

    /**
     * Checking Customer SMS is enabled or not
     * @return string
     */
    public function isCustomerNotificationsEnabledOnHold()
    {
        return $this->getConfig('tgm_voodoo_orders/hold_order/voodoo_hold_order_enabled');
    }

    /**
     * Getting Customer Sender ID
     * @return string
     */
    public function getCustomerSenderIdonHold()
    {
        return $this->getConfig('tgm_voodoo_orders/hold_order/voodoo_hold_order_sender_id');
    }

    /**
     * Getting Customer Message
     * @return string
     */
    public function getCustomerMessageOnHold()
    {
        return $this->getConfig('tgm_voodoo_orders/hold_order/voodoo_hold_order_message');
    }

    /**
     * Getting Customer Configuration
     * These functions are used to get the customer information when order is on un hold
     */

    /**
     * Checking Customer SMS is enabled or not
     * @return string
     */
    public function isCustomerNotificationsEnabledOnUnHold()
    {
        return $this->getConfig('tgm_voodoo_orders/unhold_order/voodoo_unhold_order_enabled');
    }

    /**
     * Getting Customer Sender ID
     * @return string
     */
    public function getCustomerSenderIdonUnHold()
    {
        return $this->getConfig('tgm_voodoo_orders/unhold_order/voodoo_unhold_order_sender_id');
    }

    /**
     * Getting Customer Message
     * @return string
     */
    public function getCustomerMessageOnUnHold()
    {
        return $this->getConfig('tgm_voodoo_orders/unhold_order/voodoo_unhold_order_message');
    }

    /**
     * Getting Customer Configuration
     * These functions are used to get the customer information when order is Cancelled
     */

    /**
     * Checking Customer SMS is enabled or not
     * @return string
     */
    public function isCustomerNotificationsEnabledOnCancelled()
    {
        return $this->getConfig('tgm_voodoo_orders/cancelled_order/voodoo_cancelled_order_enabled');
    }

    /**
     * Getting Customer Sender ID
     * @return string
     */
    public function getCustomerSenderIdonCancelled()
    {
        return $this->getConfig('tgm_voodoo_orders/cancelled_order/voodoo_cancelled_order_sender_id');
    }

    /**
     * Getting Customer Message
     * @return string
     */
    public function getCustomerMessageOnCancelled()
    {
        return $this->getConfig('tgm_voodoo_orders/cancelled_order/voodoo_cancelled_order_message');
    }

    /**
     * Getting Customer Configuration
     * These functions are used to get the customer information when invoice is created
     */

    /**
     * Checking Customer SMS is enabled or not
     * @return string
     */
    public function isCustomerNotificationsEnabledOnInvoiced()
    {
        return $this->getConfig('tgm_voodoo_orders/invoiced_order/voodoo_invoiced_order_enabled');
    }

    /**
     * Getting Customer Sender ID
     * @return string
     */
    public function getCustomerSenderIdonInvoiced()
    {
        return $this->getConfig('tgm_voodoo_orders/invoiced_order/voodoo_invoiced_order_sender_id');
    }

    /**
     * Getting Customer Message
     * @return string
     */
    public function getCustomerMessageOnInvoiced()
    {
        return $this->getConfig('tgm_voodoo_orders/invoiced_order/voodoo_invoiced_order_message');
    }

    /**
     * The Basics:
     * These functions are used to do the basic functionality
     */

    /**
     * Send Configuration path to this function and get the module admin Config data
     * @param @var $configPath
     * @return string
     */
    public function getConfig($configPath)
    {
        return $this->scopeConfig->getValue(
            $configPath,
            ScopeInterface::SCOPE_STORE);
    }

    /**
     * Curl Function to get the result from VoodooSMS API
     * @param @var $url
     * @return string
     */
    public function curl($url)
    {
        return file_get_contents($url);
        /*$ch = curl_init();
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $url);
        $data = curl_exec($ch);
        curl_close($ch);
        return $data;*/
    }

    /**
     * Verification of API Account
     * @param @var $username
     * @param @var $password
     * @return bool
     */
    public function verifyApi($username, $password)
    {
        $_host       = $this->_host;
        $path       = "vapi/server/getCredit";
        $data       = '?uid='.urlencode($username).
                      '&pass='.urlencode($password);
        $_format     = '&format='.$this->_format;
        $url        = $_host.$path.$data.$_format;
        $verified   = $this->curl($url);
        $verified   = json_decode($verified);
        if (isset($verified->credit)) {
            return  true;
        }
        return      false;
    }


    /**
     * Sending SMS
     * @param @var $username
     * @param @var $password
     * @param @var $senderID
     * @param @var $destination
     * @param @var $message
     * @return void
     */
    public function sendSms($username, $password, $senderID, $destination, $message)
    {
        $_host       = $this->_host;
        $path       = 'vapi/server/sendSMS?';
        $data       = 'uid='.urlencode($username).
                      '&pass='.urlencode($password).
                      '&dest='.urlencode($destination).
                      '&orig='.urlencode($senderID).
                      '&msg='.urlencode($message).
                      '&validity=300';
        $_format     = '&format='.$this->_format;
        $_platform   = '&platform='.$this->_platform.
                      '&platform_version='.$this->_platformVersion;
        $url        = $_host.$path.$data.$_format.$_platform;
        $this->curl($url);
    }

    /**
     * Getting Credits
     * @param @var $username
     * @param @var $password
     * @return bool|string
     */
    public function getCredit($username, $password)
    {
        $_host       = $this->_host;
        $path       = "vapi/server/getCredit";
        $data       = '?uid='.urlencode($username).
                      '&pass='.urlencode($password);
        $_format     = '&format='.$this->_format;
        $url        = $_host.$path.$data.$_format;
        $verified   = $this->curl($url);
        $verified   = json_decode($verified);
        if (isset($verified->credit)) {
            return  number_format($verified->credit, 2);
        }
        return      false;
    }

    /**
     * Insert Admin Config Values in the message using order data
     * @param @var $message
     * @param @var $data
     * @return string
     */
    public function manipulateSMS($message, $data)
    {
        $keywords   = [
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
        ];
        $message            = str_replace($keywords, $data, $message);
        return $message;
    }

    /**
     * The Fetchers
     * These functions are used to fetch the details using observer
     */

    /**
     * Getting Products
     * @param Observer $observer
     * @return string
     */
    public function getProduct(Observer $observer)
    {
        $productId          = $observer->getProduct()->getId();
        $objectManager      = ObjectManager::getInstance();
        $product            = $objectManager->get('Magento\Catalog\Model\Product')->load($productId);
        return $product;
    }

    /**
     * Getting Order Details
     * @param Observer $observer
     * @return string
     */
    public function getOrder(Observer $observer)
    {
        $order              = $observer->getOrder();
        $orderId            = $order->getIncrementId();
        $objectManager      = ObjectManager::getInstance();
        $order              = $objectManager->get('Magento\Sales\Model\Order');
        $orderInformation   = $order->loadByIncrementId($orderId);
        return $orderInformation;
    }
}