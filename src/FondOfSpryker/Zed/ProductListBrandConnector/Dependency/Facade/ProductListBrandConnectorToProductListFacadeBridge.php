<?php

namespace FondOfSpryker\Zed\ProductListBrandConnector\Dependency\Facade;

use FondOfSpryker\Zed\ProductList\Business\ProductListFacadeInterface;

class ProductListBrandConnectorToProductListFacadeBridge implements ProductListBrandConnectorToProductListFacadeInterface
{
    /**
     * @var \FondOfSpryker\Zed\ProductList\Business\ProductListFacadeInterface
     */
    protected $productListFacade;

    /**
     * @param \FondOfSpryker\Zed\ProductList\Business\ProductListFacadeInterface $productListFacade
     */
    public function __construct(ProductListFacadeInterface $productListFacade)
    {
        $this->productListFacade = $productListFacade;
    }

    /**
     * @param int[] $productListIds
     *
     * @return int[]
     */
    public function getProductAbstractIdsByProductListIds(array $productListIds): array
    {
        return $this->productListFacade->getProductAbstractIdsByProductListIds($productListIds);
    }
}
