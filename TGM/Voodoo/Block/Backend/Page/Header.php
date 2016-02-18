<?php
class TGM_Voodoo_Block_Backend_Page_Header
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
        $html = '<div style="background:#EAF0EE;border:1px solid #CCCCCC;margin-bottom:10px;padding:20px 15px 15px; border-radius: 5px;">
                    <img src="'.$this->getSkinUrl().'images/magepal.png" style="margin-left:-15px;"/>
                    <div style="margin: 0 auto;">

                    <h4 style="color:#EA7601;">Voodoo SMS Extension Community Edition v3.2.2 by <a target="_blank" href="http://www.topgearmedia.co.uk"><strong>Top Gear Media</strong></a></h4>
                    <h4>This module requires an account,
                     API username/password and SMS credits with <a href="http://www.voodoosms.com">www.voodoosms.com</a>.
                     <br>To register an account <a href="http://www.voodoosms.com/portal.html">click here</a>
                     <br>To view instructions on how to configure this module <a href="http://www.voodoosms.com/portal/help/online_help/?help=69&p=173#help_detail_post_173">click here</a></h4>
					<p>Query? Feel free to contact the team by <a href="http://www.voodoosms.com/contact-us.html" target="_blank">clicking here</a></p>
                    </div>

                ';

        return $html;
    }
}