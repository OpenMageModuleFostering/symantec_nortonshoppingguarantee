<?php

/**
 * Base module helper.
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
 * @category Class_Type_Helper
 * @package  Symantec_NortonShoppingGuarantee
 * @author   Symantec Corporation
 */

class Symantec_NortonShoppingGuarantee_Helper_Data 
    extends Mage_Core_Helper_Abstract
{

    const EDITION_COMMUNITY     = 'Community';
    const EDITION_ENTERPRISE    = 'Enterprise';
    const EDITION_PROFESSIONAL  = 'Professional';
    
    /**
     * Get the Magento version number.
     * 
     * @return string
     */
    public function getAppVersion()
    {
        return Mage::getVersion();
    }

    /**
     * Get the merchant hash.
     * 
     * @return string|boolean
     */
    public function getHash()
    {
        if ( ($hash = Mage::helper('core')->decrypt(Mage::getStoreConfig('nsg_options/nsg_config/nsg_hash'))) ) {
            return $hash;
        }

        return false;
    }

    /**
     * Get the store number.
     * 
     * @return string|boolean
     */
    public function getStoreNumber()
    {
        if ( ($storeNumber = Mage::getStoreConfig('nsg_options/nsg_config/nsg_shop')) ) {
            return $storeNumber;
        }
        
        return false;
    }

    /**
     * Determine whether the merchant hash is set.
     * 
     * @return boolean
     */
    public function hasHash()
    {
        if (Mage::getStoreConfig('nsg_options/nsg_config/nsg_hash')) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether a store number is available.
     * 
     * @return boolean
     */
    public function hasStoreNumber()
    {
        if (Mage::getStoreConfig('nsg_options/nsg_config/nsg_shop')) {
            return true;
        }
        
        return false;
    }

    /**
     * Determine whether the feature is enabled.
     * 
     * @return boolean
     */
    public function isEnabled()
    {
        return $this->hasHash() ? true : false;
    }

    /**
     * Perform an edition check.
     * 
     * @return string
     */
    public function register()
    {
        $modules = (array) Mage::getConfig()->getNode('modules')->children();

        if (isset($modules['Enterprise_Pci']) && $modules['Enterprise_Pci']->active == 'false') {
            return self::EDITION_PROFESSIONAL;          
        } else if (isset($modules['Enterprise_Enterprise'])) {
            return self::EDITION_ENTERPRISE;
        }

        return self::EDITION_COMMUNITY;
    }

}