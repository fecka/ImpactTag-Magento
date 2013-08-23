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

class Fecka_ImpactTag_Block_ImpactTag extends Mage_Core_Block_Template
{
    public function getFields()
    {
        $order = $this->_getOrder();
        if($order){
            $fields['cID']                    = Mage::getStoreConfig(Fecka_ImpactTag_Helper_Data::XML_PATH_CLIENT);
            $fields['order_id']               = $order->getIncrementId();
            $fields['conversion_location_id'] = "1";
            $fields['sale_value_gross']       = $this->format($order->getBaseGrandTotal());
            $fields['sale_value_net']         = $this->format($order->getBaseSubtotal());
            $fields['sale_value_delivery']    = $this->format($order->getBaseShippingAmount());
            $fields['sale_value_tax']         = $this->format($order->getBaseTaxAmount());
            $fields['sale_value_currency']    = $order->getOrderCurrencyCode();
            $fields['voucher_code']           = $order->getCouponCode();
            return $fields;
        }
        return false;
    }

    private function _getOrder(){
        if(!$this->_quote){
            $quoteId = Mage::getSingleton('checkout/session')->getLastQuoteId();
            if($quoteId){
                $this->_order = Mage::getModel('sales/order')->loadByAttribute('quote_id', $quoteId);
            }else{
               $this->_order = false;
            }
        }
        return $this->_order;
    }

    private function format($amount) 
    {
        if (!$amount)
            return 0;
        return Mage::getModel('directory/currency')->format($amount, array('display'=>Zend_Currency::NO_SYMBOL), false);
    }
}