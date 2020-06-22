<?php

namespace FondOfSpryker\Zed\ProductListBrandConnector\Business\Model;

use FondOfSpryker\Zed\ProductListBrandConnector\Dependency\Facade\ProductListBrandConnectorToBrandProductFacadeInterface;
use FondOfSpryker\Zed\ProductListBrandConnector\Dependency\Facade\ProductListBrandConnectorToProductListFacadeInterface;
use Generated\Shared\Transfer\BrandRelationTransfer;
use Generated\Shared\Transfer\ProductListTransfer;

class ProductListBrandRelationReader implements ProductListBrandRelationReaderInterface
{
    /**
     * @var \FondOfSpryker\Zed\ProductListBrandConnector\Dependency\Facade\ProductListBrandConnectorToBrandProductFacadeInterface
     */
    protected $brandProductFacade;

    /**
     * @var \FondOfSpryker\Zed\ProductListBrandConnector\Dependency\Facade\ProductListBrandConnectorToProductListFacadeInterface
     */
    protected $productListFacade;

    /**
     * @param \FondOfSpryker\Zed\ProductListBrandConnector\Dependency\Facade\ProductListBrandConnectorToBrandProductFacadeInterface $brandProductFacade
     * @param \FondOfSpryker\Zed\ProductListBrandConnector\Dependency\Facade\ProductListBrandConnectorToProductListFacadeInterface $productListFacade
     */
    public function __construct(
        ProductListBrandConnectorToBrandProductFacadeInterface $brandProductFacade,
        ProductListBrandConnectorToProductListFacadeInterface $productListFacade
    ) {
        $this->brandProductFacade = $brandProductFacade;
        $this->productListFacade = $productListFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\ProductListTransfer $productListTransfer
     *
     * @return \Generated\Shared\Transfer\BrandRelationTransfer
     */
    public function findProductListBrandRelationByIdProductList(
        ProductListTransfer $productListTransfer
    ): ProductListTransfer {
        $productAbstractIds = $this->productListFacade->getProductAbstractIdsByProductListIds([$productListTransfer->getIdProductList()]);
        $productListBrandIds = [];

        foreach ($productAbstractIds as $idProductAbstract) {
            $brandCollectionTransfer = $this->brandProductFacade->getBrandsByProductAbstractId($idProductAbstract);

            foreach ($brandCollectionTransfer->getBrands() as $brandTransfer) {
                if (!in_array($brandTransfer->getIdBrand(), $productListBrandIds, true)) {
                    $productListBrandIds[] = $brandTransfer->getIdBrand();
                }
            }
        }

        $brandRelationTransfer = (new BrandRelationTransfer())
            ->setIdProductList($productListTransfer->getIdProductList())
            ->setIdBrands($productListBrandIds);

        $productListTransfer->setBrandRelation($brandRelationTransfer);

        return $productListTransfer;
    }
}
