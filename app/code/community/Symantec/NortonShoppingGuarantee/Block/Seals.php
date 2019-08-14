<?php

/**
 * Frontend site seal image block.
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

class Symantec_NortonShoppingGuarantee_Block_Seals
    extends Mage_Core_Block_Template
{

    protected static $_isCheckoutSuccess = null;
    
    /**
     * Determine whether the merchant hash is set.
     * 
     * @return boolean
     */
    public function hasHash()
    {
         return Mage::helper('nsg')->hasHash();
    }    
    
    /**
     * Get the merchant hash.
     * 
     * @return string|boolean
     */
    public function getHash()
    {
         return Mage::helper('nsg')->getHash();
    }

    /**
     * Determine whether a store number is available.
     * 
     * @return boolean
     */
    public function hasStoreNumber()
    {
        return Mage::helper('nsg')->hasStoreNumber();
    }

    /**
     * Get the current order model.
     * 
     * @return Mage_Sales_Model_Order
     */
    public function getOrder()
    {
        if (!$this->getData('order')) {
            $this->setData(
                'order',
                Mage::getModel('sales/order')->load(
                    (int) Mage::getSingleton('checkout/session')->getLastOrderId()
                )
            );
        }

        return $this->getData('order');
    }

    /**
     * Get the store number.
     * 
     * @return string|boolean
     */
    public function getStoreNumber()
    {
        return Mage::helper('nsg')->getStoreNumber();
    }

    /**
     * Determine whether the current page is for checkout success.
     * 
     * @return boolean
     */
    public function isCheckoutSuccess()
    {
        if (is_null(self::$_isCheckoutSuccess)) {
            self::$_isCheckoutSuccess = false;

            $blocks = array('checkout.success', 'checkout_success');
            $routes = array('checkout_onepage_success', 'checkout_multishipping_success');

            if (in_array(Mage::app()->getFrontController()->getAction()->getFullActionName(), $routes)) {
                self::$_isCheckoutSuccess = true;
            } else {
                foreach ($blocks as $block) {
                    if ($this->getLayout()->getBlock($block) !== false) {
                        self::$_isCheckoutSuccess = true;
                        break;
                    }
                }
            }
        }

        return self::$_isCheckoutSuccess;
    }
    
    /**
     * Determine whether the feature is enabled.
     * 
     * @return boolean
     */
    public function isEnabled()
    {
        return Mage::helper('nsg')->isEnabled();
    }

}