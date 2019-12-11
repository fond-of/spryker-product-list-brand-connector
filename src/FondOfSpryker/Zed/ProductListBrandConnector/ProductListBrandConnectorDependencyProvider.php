<?php

namespace FondOfSpryker\Zed\ProductListBrandConnector;

use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

class ProductListBrandConnectorDependencyProvider extends AbstractBundleDependencyProvider
{
    public const FACADE_BRAND = 'FACADE_BRAND';
    public const FACADE_BRAND_PRODUCT = 'FACADE_BRAND_PRODUCT';
    public const FACADE_PRODUCT = 'FACADE_PRODUCT';
    public const FACADE_PRODUCT_LIST = 'FACADE_PRODUCT_LIST';

    public function provideBusinessLayerDependencies(Container $container)
    {
        $container = parent::provideBusinessLayerDependencies($container);
        $container = $this->provideBrandFacade($container);
        $container = $this->provideBrandProductFacade($container);
        $container = $this->provideProductFacade($container);
        $container = $this->provideProductListFacade($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function provideBrandFacade(Container $container): Container
    {
        $container[static::FACADE_BRAND] = function (Container $container) {
            return $container->getLocator()->brand()->facade();
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function provideBrandProductFacade(Container $container): Container
    {
        $container[static::FACADE_BRAND_PRODUCT] = function (Container $container) {
            return $container->getLocator()->brandProduct()->facade();
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function provideProductFacade(Container $container): Container
    {
        $container[static::FACADE_PRODUCT] = function (Container $container) {
            return $container->getLocator()->product()->facade();
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function provideProductListFacade(Container $container): Container
    {
        $container[static::FACADE_PRODUCT_LIST] = function (Container $container) {
            return $container->getLocator()->productList()->facade();
        };

        return $container;
    }
}
