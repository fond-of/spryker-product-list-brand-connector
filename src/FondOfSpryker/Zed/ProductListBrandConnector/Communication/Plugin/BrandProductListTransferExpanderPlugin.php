<?php

namespace FondOfSpryker\Zed\ProductListBrandConnector\Communication\Plugin;

use FondOfSpryker\Zed\ProductList\Dependency\Plugin\ProductListTransferExpanderPluginInterface;
use Generated\Shared\Transfer\ProductListTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfSpryker\Zed\ProductListBrandConnector\Business\ProductListBrandConnectorFacadeInterface getFacade()
 */
class BrandProductListTransferExpanderPlugin extends AbstractPlugin implements ProductListTransferExpanderPluginInterface
{
    /**
     * {@inheritdoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\ProductListTransfer $productListTransfer
     *
     * @return \Generated\Shared\Transfer\ProductListTransfer
     */
    public function expandTransfer(ProductListTransfer $productListTransfer): ProductListTransfer
    {
        return $this->getFacade()->addBrandRelationToProductList($productListTransfer);
    }
}
