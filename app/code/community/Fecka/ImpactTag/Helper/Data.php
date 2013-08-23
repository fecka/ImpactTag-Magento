<?php
/**
 *
 * NOTICE OF LICENSE
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 *
 * @category    Fecka
 * @package     ImpactTag
 * @copyright   Copyright (c) 2013 Ferenc Sonkoly
 * @license     http://www.gnu.org/licenses/gpl-3.0.html  GNU General Public License (GPL 3.0)
 */

class Fecka_ImpactTag_Helper_Data extends Mage_Core_Helper_Abstract
{
    /**
     * Config paths for using throughout the code
     */
    const XML_PATH_ACTIVE  = 'impacttag/tracking/active';
    const XML_PATH_CLIENT  = 'impacttag/tracking/client';
    const XML_PATH_TRACK   = 'impacttag/tracking/site_tracking';

    public function isAvailable($store = null)
    {
        $clientId = Mage::getStoreConfig(self::XML_PATH_CLIENT, $store);
        return $clientId && Mage::getStoreConfigFlag(self::XML_PATH_ACTIVE, $store);
    }

    public function isSiteTrackingAvailable($store = null)
    {
        return $this->isAvailable($store) && Mage::getStoreConfigFlag(self::XML_PATH_TRACK, $store);
    }
}