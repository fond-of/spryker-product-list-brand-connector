<?php

namespace FondOfSpryker\Zed\ProductListBrandConnector\Business\Expander;

use Generated\Shared\Transfer\ProductListTransfer;

interface ProductListExpanderInterface
{
    /**
     * @param \Generated\Shared\Transfer\ProductListTransfer $productListTransfer
     *
     * @return \Generated\Shared\Transfer\ProductListTransfer
     */
    public function addBrandRelationToProductListTransfer(ProductListTransfer $productListTransfer): ProductListTransfer;
}
