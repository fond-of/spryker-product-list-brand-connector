<?php

namespace FondOfSpryker\Zed\ProductListBrandConnector\Business;

use FondOfSpryker\Zed\ProductListBrandConnector\Business\Expander\ProductListExpander;
use FondOfSpryker\Zed\ProductListBrandConnector\Business\Expander\ProductListExpanderInterface;
use FondOfSpryker\Zed\ProductListBrandConnector\Business\Model\ProductListBrandRelationReader;
use FondOfSpryker\Zed\ProductListBrandConnector\Business\Model\ProductListBrandRelationReaderInterface;
use FondOfSpryker\Zed\ProductListBrandConnector\Dependency\Facade\ProductListBrandConnectorToBrandProductFacadeInterface;
use FondOfSpryker\Zed\ProductListBrandConnector\Dependency\Facade\ProductListBrandConnectorToProductListFacadeInterface;
use FondOfSpryker\Zed\ProductListBrandConnector\ProductListBrandConnectorDependencyProvider;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

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
            $this->getBrandProductFacade(),
            $this->getProductListFacade()
        );
    }

    /**
     * @return \FondOfSpryker\Zed\ProductListBrandConnector\Business\Model\ProductListBrandRelationReaderInterface
     */
    public function createProductListBrandRelationReader(): ProductListBrandRelationReaderInterface
    {
        return new ProductListBrandRelationReader(
            $this->getBrandProductFacade(),
            $this->getProductListFacade()
        );
    }

    /**
     * @return \FondOfSpryker\Zed\ProductListBrandConnector\Dependency\Facade\ProductListBrandConnectorToBrandProductFacadeInterface
     */
    public function getBrandProductFacade(): ProductListBrandConnectorToBrandProductFacadeInterface
    {
        return $this->getProvidedDependency(ProductListBrandConnectorDependencyProvider::FACADE_BRAND_PRODUCT);
    }

    /**
     * @return \FondOfSpryker\Zed\ProductListBrandConnector\Dependency\Facade\ProductListBrandConnectorToProductListFacadeInterface
     */
    public function getProductListFacade(): ProductListBrandConnectorToProductListFacadeInterface
    {
        return $this->getProvidedDependency(ProductListBrandConnectorDependencyProvider::FACADE_PRODUCT_LIST);
    }
}
