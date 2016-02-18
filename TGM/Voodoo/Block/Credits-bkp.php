<?php
class TGM_Voodoo_Block_Credits extends Mage_Adminhtml_Block_System_Config_Form_Field
{
    protected function _getElementHtml(Varien_Data_Form_Element_Abstract $element)
    {
        $this->setElement($element);
        $credit = Mage::getModel('voodoo/voodoo')->getCredit();
        if ($credit == '401:	Unauthorized') {
            $credit = 'There is an error check verification message';
            $html ="<div style='font-size: 12px;'>$credit</div><a target='_blank' href='https://www.voodoosms.com/portal/account/addcredit'>Add More Credits</a>";
        }
        else{
            $credits = explode('.',$credit);
            $url = 'http://www.voodoosms.com/register.html';
            if($credit[0]>0){
                $html ="<div style='font-weight:bold;font-size: 14px;'>$credits[0]</div><a target='_blank' href='https://www.voodoosms.com/portal/account/addcredit'>Add More Credits</a>";
            }
            else{
                $html ="<div style='font-weight:bold;font-size: 14px;'>You have insufficient credits</div><a target='_blank' href='https://www.voodoosms.com/portal/account/addcredit'>Add More Credits</a>";
            }
        }
        return $html;
    }
}

?>