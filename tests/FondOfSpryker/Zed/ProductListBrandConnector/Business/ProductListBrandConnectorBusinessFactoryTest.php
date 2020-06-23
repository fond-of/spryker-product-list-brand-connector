<?php

namespace FondOfSpryker\Zed\ProductListBrandConnector\Business;

use Codeception\Test\Unit;
use FondOfSpryker\Zed\ProductListBrandConnector\Business\Expander\ProductListExpander;
use FondOfSpryker\Zed\ProductListBrandConnector\Business\Model\ProductListBrandRelationReader;
use FondOfSpryker\Zed\ProductListBrandConnector\Dependency\Facade\ProductListBrandConnectorToBrandProductFacadeInterface;
use FondOfSpryker\Zed\ProductListBrandConnector\Dependency\Facade\ProductListBrandConnectorToProductListFacadeInterface;
use FondOfSpryker\Zed\ProductListBrandConnector\ProductListBrandConnectorDependencyProvider;
use Spryker\Zed\Kernel\Container;

class ProductListBrandConnectorBusinessFactoryTest extends Unit
{
    /**
     * @var \FondOfSpryker\Zed\ProductListBrandConnector\Business\ProductListBrandConnectorBusinessFactory
     */
    protected $productListBrandConnectorBusinessFactory;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\ProductListBrandConnector\Dependency\Facade\ProductListBrandConnectorToBrandProductFacadeInterface
     */
    protected $productListBrandConnectorToBrandProductFacadeInterfaceMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\ProductListBrandConnector\Dependency\Facade\ProductListBrandConnectorToProductListFacadeInterface
     */
    protected $productListBrandConnectorToProductListFacadeInterfaceMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productListBrandConnectorToBrandProductFacadeInterfaceMock = $this->getMockBuilder(ProductListBrandConnectorToBrandProductFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productListBrandConnectorToProductListFacadeInterfaceMock = $this->getMockBuilder(ProductListBrandConnectorToProductListFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productListBrandConnectorBusinessFactory = new ProductListBrandConnectorBusinessFactory();
        $this->productListBrandConnectorBusinessFactory->setContainer($this->containerMock);
    }

    /**
     * @return void
     */
    public function testCreateProductListExpander(): void
    {
        $this->containerMock->expects($this->atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects($this->atLeastOnce())
            ->method('get')
            ->withConsecutive(
                [ProductListBrandConnectorDependencyProvider::FACADE_BRAND_PRODUCT],
                [ProductListBrandConnectorDependencyProvider::FACADE_PRODUCT_LIST]
            )->willReturnOnConsecutiveCalls(
                $this->productListBrandConnectorToBrandProductFacadeInterfaceMock,
                $this->productListBrandConnectorToProductListFacadeInterfaceMock
            );

        $this->assertInstanceOf(
            ProductListExpander::class,
            $this->productListBrandConnectorBusinessFactory->createProductListExpander()
        );
    }

    /**
     * @return void
     */
    public function testCreateProductListBrandRelationReader(): void
    {
        $this->containerMock->expects($this->atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects($this->atLeastOnce())
            ->method('get')
            ->withConsecutive(
                [ProductListBrandConnectorDependencyProvider::FACADE_BRAND_PRODUCT],
                [ProductListBrandConnectorDependencyProvider::FACADE_PRODUCT_LIST]
            )->willReturnOnConsecutiveCalls(
                $this->productListBrandConnectorToBrandProductFacadeInterfaceMock,
                $this->productListBrandConnectorToProductListFacadeInterfaceMock
            );

        $this->assertInstanceOf(
            ProductListBrandRelationReader::class,
            $this->productListBrandConnectorBusinessFactory->createProductListBrandRelationReader()
        );
    }
}
