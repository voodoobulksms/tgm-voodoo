<?php
class TGM_Voodoo_Block_OtherVerifications extends Mage_Adminhtml_Block_System_Config_Form_Field
{
    protected function _getElementHtml(Varien_Data_Form_Element_Abstract $element)
    {
        $this->setElement($element);
        $verified = Mage::getModel('voodoo/voodoo')->verify_others();
        if($verified == 1){
            $verified = "Configuration is correct according to our API documentation";
            $html ="<div style='font-weight: bold; font-size: 14px; color:green;'>$verified</div>";
        }
        else{
        $verified = "You have entered any non permitted word to see the whole list of these word check documentation.";
        $html ="<div style='font-weight: bold; font-size: 14px; color:red;'>$verified</div>";
        }
        return $html;
    }
}
?>