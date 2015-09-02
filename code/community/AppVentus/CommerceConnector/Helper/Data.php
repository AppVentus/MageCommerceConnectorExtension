<?php
class AppVentus_CommerceConnector_Helper_Data extends Mage_Core_Helper_Abstract
{
    /**
     * Return retail number
     *
     * @return void
     * @author
     **/
    public function getRetailNumber($eans)
    {
        $retails = $this->getRetails($eans);

        return count($retails);
    }

    /**
     * Return bool if product has retailer
     *
     * @return void
     * @author
     **/
    public function getRetails(array $eans)
    {
        $this->commerceConnector = new CommerceConnector();
        $shopRequest = $this->commerceConnector->shoprequest($eans);

        return $shopRequest;
    }
}
