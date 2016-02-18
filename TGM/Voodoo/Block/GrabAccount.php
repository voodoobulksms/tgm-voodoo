<?php
class TGM_Voodoo_Block_GrabAccount extends Mage_Adminhtml_Block_System_Config_Form_Field
{
    protected function _getElementHtml(Varien_Data_Form_Element_Abstract $element)
    {
        $this->setElement($element);
		$url = 'http://www.voodoosms.com/register.html';
        $html = $this->getLayout()->createBlock('adminhtml/widget_button')
                    ->setType('button')
                    ->setClass('button')
                    ->setLabel(Mage::helper('voodoo')->__('Link Account'))
                    ->setOnClick("window.open('$url','window1','width=870, height=705, scrollbars=1, resizable=1'); return false;")
                    ->toHtml();
        return $html;
    }
}
?>
