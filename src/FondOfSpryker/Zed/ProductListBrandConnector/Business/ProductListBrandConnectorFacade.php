<?php

namespace FondOfSpryker\Zed\ProductListBrandConnector\Business;

use Generated\Shared\Transfer\ProductListTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfSpryker\Zed\ProductListBrandConnector\Business\ProductListBrandConnectorBusinessFactory getFactory()
 */
class ProductListBrandConnectorFacade extends AbstractFacade implements ProductListBrandConnectorFacadeInterface
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
    public function addBrandRelationToProductList(ProductListTransfer $productListTransfer): ProductListTransfer
    {
        return $this->getFactory()
            ->createProductListExpander()
            ->addBrandRelationToProductListTransfer($productListTransfer);
    }

    /**
     * {@inheritdoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\ProductListTransfer $productListTransfer
     *
     * @return \Generated\Shared\Transfer\ProductListTransfer
     */
    public function findProductListBrandRelationByIdProductList(ProductListTransfer $productListTransfer): ProductListTransfer
    {
        return $this->getFactory()
            ->createProductListBrandRelationReader()
            ->findProductListBrandRelationByIdProductList($productListTransfer);
    }
}
