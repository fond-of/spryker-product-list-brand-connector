<?php

namespace FondOfSpryker\Zed\ProductListBrandConnector\Communication\Plugin\ProductListExtension;

use FondOfSpryker\Zed\ProductListExtension\Dependency\Plugin\ProductListTransferExpanderPluginInterface;
use Generated\Shared\Transfer\ProductListTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfSpryker\Zed\ProductListBrandConnector\Business\ProductListBrandConnectorFacadeInterface getFacade()
 * @method \FondOfSpryker\Zed\ProductListBrandConnector\ProductListBrandConnectorConfig getConfig()
 */
class BrandProductListTransferExpanderPlugin extends AbstractPlugin implements ProductListTransferExpanderPluginInterface
{
    /**
     * {@inheritDoc}
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
