<?php

require_once 'app/code/community/AppVentus/CommerceConnector/lib/CommerceConnector.php';

class AppVentus_CommerceConnector_Block_ListSellers extends Mage_Core_Block_Template
{
    protected function _construct()
    {
        $apiWsdl = Mage::getStoreConfig('catalog/commerce_connector/commerce_connector_api_wsdl');
        $apiKey = Mage::getStoreConfig('catalog/commerce_connector/commerce_connector_api_key');
        $apiSecret = Mage::getStoreConfig('catalog/commerce_connector/commerce_connector_api_secret');
        $apiSubid = Mage::getStoreConfig('catalog/commerce_connector/commerce_connector_api_subid');
        $this->commerceConnector = new CommerceConnector($apiWsdl, $apiKey, $apiSecret, $apiSubid);
        $current_product = Mage::registry('current_product');
        $shopRequest = $this->commerceConnector->shoprequest(array($current_product->getEan()));
        $this->assign('shoplist', $shopRequest[0]['shoplist']);
        $this->setTemplate('commerceconnector/listSellers.phtml');
    }
}
