<?php

namespace FondOfSpryker\Zed\ProductListBrandConnector;

use Codeception\Test\Unit;
use Spryker\Zed\Kernel\Container;

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
     * @return void
     */
    protected function _before(): void
    {
        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productListBrandConnectorDependencyProvider = new ProductListBrandConnectorDependencyProvider();
    }

    /**
     * @return void
     */
    public function testProvideBusinessLayerDependencies(): void
    {
        $this->assertInstanceOf(
            Container::class,
            $this->productListBrandConnectorDependencyProvider->provideBusinessLayerDependencies(
                $this->containerMock
            )
        );
    }
}
