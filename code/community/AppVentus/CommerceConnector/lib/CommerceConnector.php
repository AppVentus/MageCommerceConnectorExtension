<?php

/**
 * Commerce Connector
 *
 * @package AppVentus_CommerceConnector
 * @author Leny BERNARD <leny@appventus.com>
 **/
class CommerceConnector
{
    private $wsdl;
    private $username;
    private $password;
    private $subid;
    private $options = array();

    public function __construct()
    {
        $this->wsdl = Mage::getStoreConfig('catalog/commerce_connector/commerce_connector_api_wsdl');
        $this->username = Mage::getStoreConfig('catalog/commerce_connector/commerce_connector_api_key');
        $this->password = Mage::getStoreConfig('catalog/commerce_connector/commerce_connector_api_secret');
        $this->subid = Mage::getStoreConfig('catalog/commerce_connector/commerce_connector_api_subid');
    }

    public function check($ean_codes, $options = null)
    {
        try {
            $this->mergeOptions($options);

            $soapClient = new Zend_Soap_Client($this->wsdl);

            return $soapClient->check($this->formatEAN($ean_codes), $this->username, $this->password, $this->options);
        } catch (Exception $e) {
            throw new Zend_Exception('Connector Service unavailable');
        }
    }

    public function shoprequest($ean_codes, $options = null)
    {
        try {
            $options['filter_subid'] = $this->subid;
            $this->mergeOptions($options);

            $soapClient = new Zend_Soap_Client($this->wsdl);

            return $soapClient->shoprequest($this->formatEAN($ean_codes), $this->username, $this->password, $this->options);
        } catch (Exception $e) {
            throw new Zend_Exception('Connector Service unavailable');
        }
    }

    private function mergeOptions($options)
    {
        if (!is_null($options) && is_array($options)) {
            $this->options = array_merge($this->options, $options);
        }
    }

    private function formatEAN($ean_codes)
    {
        if (! is_array($ean_codes)) {
            return array($ean_codes);
        }

        return $ean_codes;
    }
}
