<?php

namespace FondOfSpryker\Zed\ProductListBrandConnector\Business;

use Generated\Shared\Transfer\BrandRelationTransfer;
use Generated\Shared\Transfer\ProductListTransfer;

interface ProductListBrandConnectorFacadeInterface
{
    /**
     * Specification:
     *  - adds the brand to the Productlist Transfer object
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\ProductListTransfer $productListTransfer
     *
     * @return \Generated\Shared\Transfer\ProductListTransfer
     */
    public function addBrandRelationToProductList(ProductListTransfer $productListTransfer): ProductListTransfer;

    /**
     * Specification:
     *  - Retrieves the brands for Productlist id
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\ProductListTransfer $productListTransfer
     *
     * @return \Generated\Shared\Transfer\BrandRelationTransfer
     */
    public function findProductListBrandRelationByIdProductList(ProductListTransfer $productListTransfer): BrandRelationTransfer;
}
