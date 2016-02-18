<?php
class TGM_Voodoo_Block_VerifyApiAccount extends \Magento\Config\Block\System\Config\Form\Field
{
    protected function _getElementHtml(\Magento\Framework\Data\Form\Element\AbstractElement $element)
    {
        //$this->setElement($element);

        $verified = 0; //Mage::getModel('voodoo/voodoo')->verify_api();
        if ($verified != '1') {
            $verified = 'Enter correct combination of username and password';
            $html ="<div style='font-weight: bold; font-size: 14px; color:red;'>$verified</div>";
        }
        else{
        $verified = "Your username and password are correct";
        $html ="<div style='font-weight: bold; font-size: 14px; color:green;'>$verified</div>";
        }

        return $html;



    }
}
?>