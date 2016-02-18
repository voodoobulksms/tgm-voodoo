<?php
class TGM_Voodoo_Block_Backend_Page_Footer
    extends Mage_Adminhtml_Block_Abstract
    implements Varien_Data_Form_Element_Renderer_Interface
{

    /**
     * Render fieldset html
     *
     * @param Varien_Data_Form_Element_Abstract $element
     * @return string
     */
    public function render(Varien_Data_Form_Element_Abstract $element)
    {
        $html = '
<div style="border-top: 2px solid #ddd; margin-top: 15px; padding:10px; text-align: right; font-size:10px;>"
                    <p>Powered By: <span style="font-size: 12px; font-weight: bold; color:#333;">Voodoo SMS</span> </p>
                </div>
                </div>
                ';

        return $html;
    }
}