<?php
class AppVentus_CommerceConnector_Helper_Data extends Mage_Core_Helper_Abstract
{
    /**
     * Return retail number
     *
     * @return void
     * @author 
     **/
    public function getRetailNumber($ean)
    {
        $retails = $this->getRetails($ean);
        return count($retails);
    }

    /**
     * Return bool if product has retailer
     *
     * @return void
     * @author 
     **/
    public function getRetails($ean)
    {
        $this->commerceConnector = new CommerceConnector();
        $shopRequest = $this->commerceConnector->shoprequest(array($ean));
        return $shopRequest[0]['shoplist'];
    }
}
	 