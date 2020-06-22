<?php

namespace FondOfSpryker\Zed\ProductListBrandConnector\Business\Model;

use Generated\Shared\Transfer\ProductListTransfer;

interface ProductListBrandRelationReaderInterface
{
    /**
     * @param \Generated\Shared\Transfer\ProductListTransfer $productListTransfer
     *
     * @return \Generated\Shared\Transfer\ProductListTransfer
     */
    public function findProductListBrandRelationByIdProductList(
        ProductListTransfer $productListTransfer
    ): ProductListTransfer;
}
