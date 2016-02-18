<?php

class TGM_Voodoo_Block_Onepage_Voodoo extends Mage_Checkout_Block_Onepage_Abstract
{
    protected function _construct()
    {    	
        $this->getCheckout()->setStepData('voodoo', array(
            'label'     => Mage::helper('checkout')->__('SMS Notifications'),
            'is_show'   => true
        ));
        
        parent::_construct();
    }
}