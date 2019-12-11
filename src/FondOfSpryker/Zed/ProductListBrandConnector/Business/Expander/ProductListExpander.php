<?php

namespace FondOfSpryker\Zed\ProductListBrandConnector\Business\Expander;

use FondOfSpryker\Zed\Brand\Business\BrandFacadeInterface;
use FondOfSpryker\Zed\BrandProduct\Business\BrandProductFacadeInterface;
use FondOfSpryker\Zed\Product\Business\ProductFacadeInterface;
use FondOfSpryker\Zed\ProductList\Business\ProductListFacade;
use FondOfSpryker\Zed\ProductListBrandConnector\ProductListBrandConnectorConfig;
use Generated\Shared\Transfer\BrandRelationTransfer;
use Generated\Shared\Transfer\ProductListTransfer;

class ProductListExpander implements ProductListExpanderInterface
{
    /**
     * @var \FondOfSpryker\Zed\ProductListBrandConnector\ProductListBrandConnectorConfig
     */
    protected $productListBrandConnectorConfig;

    /**
     * @var \FondOfSpryker\Zed\Brand\Business\BrandFacadeInterface
     */
    protected $brandFacade;

    /**
     * @var \FondOfSpryker\Zed\BrandProduct\Business\BrandProductFacadeInterface
     */
    protected $brandProductFacade;
    /**
     * @var \FondOfSpryker\Zed\Product\Business\ProductFacadeInterface
     */
    protected $productFacade;

    /**
     * @var \FondOfSpryker\Zed\ProductList\Business\ProductListFacade
     */
    protected $productListFacade;

    /**
     * ProductListExpander constructor.
     *
     * @param \FondOfSpryker\Zed\Brand\Business\BrandFacadeInterface $brandFacade
     * @param \FondOfSpryker\Zed\BrandProduct\Business\BrandProductFacadeInterface $brandProductFacade
     * @param \FondOfSpryker\Zed\Product\Business\ProductFacadeInterface $productFacade
     * @param \FondOfSpryker\Zed\ProductList\Business\ProductListFacade $productListFacade
     * @param \FondOfSpryker\Zed\ProductListBrandConnector\ProductListBrandConnectorConfig $productListBrandConnectorConfig
     */
    public function __construct(
        BrandFacadeInterface $brandFacade,
        BrandProductFacadeInterface $brandProductFacade,
        ProductFacadeInterface $productFacade,
        ProductListFacade $productListFacade,
        ProductListBrandConnectorConfig $productListBrandConnectorConfig
    ) {
        $this->productListBrandConnectorConfig = $productListBrandConnectorConfig;
        $this->brandFacade = $brandFacade;
        $this->brandProductFacade = $brandProductFacade;
        $this->productFacade = $productFacade;
        $this->productListFacade = $productListFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\ProductListTransfer $productListTransfer
     *
     * @return \Generated\Shared\Transfer\ProductListTransfer
     */
    public function addBrandRelationToProductListTransfer(ProductListTransfer $productListTransfer): ProductListTransfer
    {
        $productAbstractIds = $this->productListFacade->getProductAbstractIdsByProductListIds([$productListTransfer->getIdProductList()]);
        $productListBrandIds = [];

        foreach ($productAbstractIds as $idProductAbstract) {
            $brandCollectionTransfer = $this->brandProductFacade->getBrandsByProductAbstractId($idProductAbstract);

            foreach ($brandCollectionTransfer->getBrands() as $brandTransfer) {
                if (array_search($brandTransfer->getIdBrand(), $productListBrandIds) === false) {
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
