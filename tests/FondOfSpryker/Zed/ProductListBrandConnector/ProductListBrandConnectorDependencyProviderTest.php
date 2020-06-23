<?php

namespace FondOfSpryker\Zed\ProductListBrandConnector;

use Codeception\Test\Unit;
use FondOfSpryker\Zed\BrandProduct\Business\BrandProductFacadeInterface;
use FondOfSpryker\Zed\ProductList\Business\ProductListFacadeInterface;
use FondOfSpryker\Zed\ProductListBrandConnector\Dependency\Facade\ProductListBrandConnectorToBrandProductFacadeBridge;
use FondOfSpryker\Zed\ProductListBrandConnector\Dependency\Facade\ProductListBrandConnectorToProductListFacadeBridge;
use Spryker\Shared\Kernel\BundleProxy;
use Spryker\Zed\Kernel\Container;
use Spryker\Zed\Kernel\Locator;

class ProductListBrandConnectorDependencyProviderTest extends Unit
{
    /**
     * @var \FondOfSpryker\Zed\ProductListBrandConnector\ProductListBrandConnectorDependencyProvider
     */
    protected $productListBrandConnectorDependencyProvider;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Locator
     */
    protected $locatorMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Shared\Kernel\BundleProxy
     */
    protected $bundleProxyMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\BrandProduct\Business\BrandProductFacadeInterface
     */
    protected $brandProductFacadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\ProductList\Business\ProductListFacadeInterface
     */
    protected $productListFacadeMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->containerMock = $this->getMockBuilder(Container::class)
            ->setMethodsExcept(['factory', 'set', 'offsetSet', 'get', 'offsetGet'])
            ->getMock();

        $this->locatorMock = $this->getMockBuilder(Locator::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->bundleProxyMock = $this->getMockBuilder(BundleProxy::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->brandProductFacadeMock = $this->getMockBuilder(BrandProductFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productListFacadeMock = $this->getMockBuilder(ProductListFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productListBrandConnectorDependencyProvider = new ProductListBrandConnectorDependencyProvider();
    }

    /**
     * @return void
     */
    public function testProvideBusinessLayerDependencies(): void
    {
        $this->containerMock->expects($this->atLeastOnce())
            ->method('getLocator')
            ->willReturn($this->locatorMock);

        $this->locatorMock->expects($this->atLeastOnce())
            ->method('__call')
            ->withConsecutive(['brandProduct'], ['productList'])
            ->willReturn($this->bundleProxyMock);

        $this->bundleProxyMock->expects($this->atLeastOnce())
            ->method('__call')
            ->with('facade')
            ->willReturnOnConsecutiveCalls(
                $this->brandProductFacadeMock,
                $this->productListFacadeMock
            );

        $container = $this->productListBrandConnectorDependencyProvider->provideBusinessLayerDependencies(
            $this->containerMock
        );

        $this->assertEquals($this->containerMock, $container);
        $this->assertInstanceOf(
            ProductListBrandConnectorToBrandProductFacadeBridge::class,
            $container[ProductListBrandConnectorDependencyProvider::FACADE_BRAND_PRODUCT]
        );
        $this->assertInstanceOf(
            ProductListBrandConnectorToProductListFacadeBridge::class,
            $container[ProductListBrandConnectorDependencyProvider::FACADE_PRODUCT_LIST]
        );
    }
}
