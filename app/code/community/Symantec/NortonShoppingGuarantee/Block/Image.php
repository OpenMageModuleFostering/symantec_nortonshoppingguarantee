<?php

/**
 * Site seal image block.
 * 
 * PHP Version 5
 * 
 * @category  Class
 * @package   Symantec_NortonShoppingGuarantee
 * @author    Symantec Corporation
 * @copyright 2016 Symantec Corporation, All Rights Reserved.
 */

/**
 * Class declaration
 *
 * @category Class_Type_Block
 * @package  Symantec_NortonShoppingGuarantee
 * @author   Symantec Corporation
 */

class Symantec_NortonShoppingGuarantee_Block_Image 
    extends Mage_Adminhtml_Block_Abstract 
       implements Varien_Data_Form_Element_Renderer_Interface
{

    /**
     * Render the element.
     * 
     * @param Varien_Data_Form_Element_Abstract $fieldset The fieldset element.
     * 
     * @return string
     */
    public function render(Varien_Data_Form_Element_Abstract $fieldset)
    {
        return $fieldset->getOriginalData('label');
    }

}