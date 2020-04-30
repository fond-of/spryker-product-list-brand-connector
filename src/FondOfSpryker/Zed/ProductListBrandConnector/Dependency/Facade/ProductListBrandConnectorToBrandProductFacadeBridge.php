<?php

namespace FondOfSpryker\Zed\ProductListBrandConnector\Dependency\Facade;

use FondOfSpryker\Zed\BrandProduct\Business\BrandProductFacadeInterface;
use Generated\Shared\Transfer\BrandCollectionTransfer;

class ProductListBrandConnectorToBrandProductFacadeBridge implements ProductListBrandConnectorToBrandProductFacadeInterface
{
    /**
     * @var \FondOfSpryker\Zed\BrandProduct\Business\BrandProductFacadeInterface
     */
    protected $brandProductFacade;

    /**
     * @param \FondOfSpryker\Zed\BrandProduct\Business\BrandProductFacadeInterface $brandProductFacade
     */
    public function __construct(BrandProductFacadeInterface $brandProductFacade)
    {
        $this->brandProductFacade = $brandProductFacade;
    }

    /**
     * @param int $idProductAbstract
     *
     * @return \Generated\Shared\Transfer\BrandCollectionTransfer
     */
    public function getBrandsByProductAbstractId(int $idProductAbstract): BrandCollectionTransfer
    {
        return $this->brandProductFacade->getBrandsByProductAbstractId($idProductAbstract);
    }
}
