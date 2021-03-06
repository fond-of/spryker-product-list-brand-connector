<?php

namespace FondOfSpryker\Zed\ProductListBrandConnector\Business;

use Generated\Shared\Transfer\BrandRelationTransfer;
use Generated\Shared\Transfer\ProductListTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfSpryker\Zed\ProductListBrandConnector\Business\ProductListBrandConnectorBusinessFactory getFactory()
 */
class ProductListBrandConnectorFacade extends AbstractFacade implements ProductListBrandConnectorFacadeInterface
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
    public function addBrandRelationToProductList(ProductListTransfer $productListTransfer): ProductListTransfer
    {
        return $this->getFactory()
            ->createProductListExpander()
            ->addBrandRelationToProductListTransfer($productListTransfer);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\ProductListTransfer $productListTransfer
     * @return \Generated\Shared\Transfer\BrandRelationTransfer
     */
    public function findProductListBrandRelationByIdProductList(ProductListTransfer $productListTransfer): BrandRelationTransfer
    {
        return $this->getFactory()
            ->createProductListBrandRelationReader()
            ->findProductListBrandRelationByIdProductList($productListTransfer);
    }
}
