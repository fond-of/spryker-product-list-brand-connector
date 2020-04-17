<?php

namespace FondOfSpryker\Zed\ProductListBrandConnector\Dependency\Facade;

use Codeception\Test\Unit;
use FondOfSpryker\Zed\ProductList\Business\ProductListFacadeInterface;

class ProductListBrandConnectorToProductListFacadeBridgeTest extends Unit
{
    /**
     * @var \FondOfSpryker\Zed\ProductListBrandConnector\Dependency\Facade\ProductListBrandConnectorToProductListFacadeBridge
     */
    protected $productListBrandConnectorToProductListFacadeBridge;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\ProductList\Business\ProductListFacadeInterface
     */
    protected $productListFacadeInterfaceMock;

    /**
     * @var int[]
     */
    protected $productListIds;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->productListFacadeInterfaceMock = $this->getMockBuilder(ProductListFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productListIds = [1];

        $this->productListBrandConnectorToProductListFacadeBridge = new ProductListBrandConnectorToProductListFacadeBridge(
            $this->productListFacadeInterfaceMock
        );
    }

    /**
     * @return void
     */
    public function testGetProductAbstractIdsByProductListIds(): void
    {
        $this->productListFacadeInterfaceMock->expects($this->atLeastOnce())
            ->method('getProductAbstractIdsByProductListIds')
            ->with($this->productListIds)
            ->willReturn($this->productListIds);

        $this->assertIsArray(
            $this->productListBrandConnectorToProductListFacadeBridge->getProductAbstractIdsByProductListIds(
                $this->productListIds
            )
        );
    }
}
