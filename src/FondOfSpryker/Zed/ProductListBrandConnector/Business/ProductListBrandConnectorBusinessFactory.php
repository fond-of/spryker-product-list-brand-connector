<?php

namespace FondOfSpryker\Zed\ProductListBrandConnector\Business;

use FondOfSpryker\Zed\Brand\Business\BrandFacadeInterface;
use FondOfSpryker\Zed\BrandProduct\Business\BrandProductFacadeInterface;
use FondOfSpryker\Zed\ProductListBrandConnector\Business\Expander\ProductListExpander;
use FondOfSpryker\Zed\ProductListBrandConnector\Business\Expander\ProductListExpanderInterface;
use FondOfSpryker\Zed\ProductListBrandConnector\ProductListBrandConnectorDependencyProvider;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;
use Spryker\Zed\Product\Business\ProductFacadeInterface;
use Spryker\Zed\ProductList\Business\ProductListFacadeInterface;

/**
 * @method \FondOfSpryker\Zed\ProductListBrandConnector\ProductListBrandConnectorConfig getConfig()
 */
class ProductListBrandConnectorBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfSpryker\Zed\ProductListBrandConnector\Business\Expander\ProductListExpanderInterface
     */
    public function createProductListExpander(): ProductListExpanderInterface
    {
        return new ProductListExpander(
            $this->getBrandFacade(),
            $this->getBrandProductFacade(),
            $this->getProductFacade(),
            $this->getProductListFacade(),
            $this->getConfig()
        );
    }

    /**
     * @throws
     *
     * @return \FondOfSpryker\Zed\Brand\Business\BrandFacadeInterface
     */
    public function getBrandFacade(): BrandFacadeInterface
    {
        return $this->getProvidedDependency(ProductListBrandConnectorDependencyProvider::FACADE_BRAND);
    }

    /**
     * @throws
     *
     * @return \FondOfSpryker\Zed\BrandProduct\Business\BrandProductFacadeInterface
     */
    public function getBrandProductFacade(): BrandProductFacadeInterface
    {
        return $this->getProvidedDependency(ProductListBrandConnectorDependencyProvider::FACADE_BRAND_PRODUCT);
    }

    public function getProductFacade(): ProductFacadeInterface
    {
        return $this->getProvidedDependency(ProductListBrandConnectorDependencyProvider::FACADE_PRODUCT);
    }

    public function getProductListFacade(): ProductListFacadeInterface
    {
        return $this->getProvidedDependency(ProductListBrandConnectorDependencyProvider::FACADE_PRODUCT_LIST);
    }
}
