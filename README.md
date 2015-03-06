# MageCommerceConnectorExtension

Merge this app folder with a magento project's one.

Then, go to the system configuration and enter the CommerceConnector configuration (System > Configuration > Catalog > Catalog > Commerce Connector)

Add this line to your `layout/catalog.xml`:

    <block type="commerceconnector/listSellers" name="commerceconnector" as="commerceconnector">
        <label>product.commerceconnector</label>
    </block>


Add this line to your `app/design/frontend/YOU/default/template/catalog/product/view.phtml`:

    <?php echo $this->getChildHtml('commerceconnector') ?>