<?php

require_once 'app/code/community/AppVentus/CommerceConnector/lib/CommerceConnector.php';

class AppVentus_CommerceConnector_Block_ListSellers extends Mage_Core_Block_Template
{
    protected function _construct()
    {
        $commerceConnectorModel = Mage::helper('commerceconnector');
        $current_product = Mage::registry('current_product');
        $retails = $commerceConnectorModel->getRetails($current_product->getEan());
        $this->assign('shoplist', $retails);
        $this->setTemplate('commerceconnector/listSellers.phtml');
    }
}
