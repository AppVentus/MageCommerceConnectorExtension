<?php

require_once 'app/code/community/AppVentus/CommerceConnector/lib/CommerceConnector.php';

class AppVentus_CommerceConnector_Block_ListSellers extends Mage_Core_Block_Template
{
    protected function _construct()
    {
        $commerceConnectorModel = Mage::helper('commerceconnector');
        $current_product = Mage::registry('current_product');
        if ($current_product->isConfigurable()) {
            $childIds = Mage::getModel('catalog/product_type_configurable')->getChildrenIds($current_product->getId());

            $retails = array();
            foreach ($childIds[0] as $childId) {
                $simpleProduct = Mage::getModel('catalog/product')->load($childId);
                $eans = array($simpleProduct->getEan());
                if ($simpleProduct->getEanCc()) {
                    $eans[] = $simpleProduct->getEanCc();
                }
                if ($childId == $current_product->getRefPref()) {
                    $currentEans = $eans;
                }
                $simpleRetails = $commerceConnectorModel->getRetails($eans);
                $retails[$simpleProduct->getEan()] = $simpleRetails;
            }
        } else {
            $eans = array($current_product->getEan());
            if ($current_product->getEanCc()) {
                $eans[] = $current_product->getEanCc();
            }
            $currentEans = $eans;
            $simpleRetails = $commerceConnectorModel->getRetails($eans);
            $retails[$current_product->getEan()] = $simpleRetails;
        }
        $this->assign('currentEans', $currentEans);
        $this->assign('shoplist', $retails);
        $this->setTemplate('commerceconnector/listSellers.phtml');
    }
}
