<?php

namespace FondOfSpryker\Zed\ProductListBrandConnector\Business;

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
}
