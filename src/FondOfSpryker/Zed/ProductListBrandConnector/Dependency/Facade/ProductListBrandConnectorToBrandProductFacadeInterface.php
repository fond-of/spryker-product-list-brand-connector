<?php

namespace FondOfSpryker\Zed\ProductListBrandConnector\Dependency\Facade;

use Generated\Shared\Transfer\BrandCollectionTransfer;

interface ProductListBrandConnectorToBrandProductFacadeInterface
{
    /**
     * @param int $idProductAbstract
     *
     * @return \Generated\Shared\Transfer\BrandCollectionTransfer
     */
    public function getBrandsByProductAbstractId(int $idProductAbstract): BrandCollectionTransfer;
}
