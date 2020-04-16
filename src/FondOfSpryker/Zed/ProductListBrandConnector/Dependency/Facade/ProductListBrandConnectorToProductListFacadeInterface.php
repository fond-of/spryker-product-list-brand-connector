<?php

namespace FondOfSpryker\Zed\ProductListBrandConnector\Dependency\Facade;

interface ProductListBrandConnectorToProductListFacadeInterface
{
    /**
     * @param int[] $productListIds
     *
     * @return int[]
     */
    public function getProductAbstractIdsByProductListIds(array $productListIds): array;
}
