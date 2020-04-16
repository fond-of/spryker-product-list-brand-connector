<?php

namespace FondOfSpryker\Zed\ProductListBrandConnector\Dependency\Facade;

use Codeception\Test\Unit;
use FondOfSpryker\Zed\BrandProduct\Business\BrandProductFacadeInterface;
use Generated\Shared\Transfer\BrandCollectionTransfer;

class ProductListBrandConnectorToBrandProductFacadeBridgeTest extends Unit
{
    /**
     * @var \FondOfSpryker\Zed\ProductListBrandConnector\Dependency\Facade\ProductListBrandConnectorToBrandProductFacadeBridge
     */
    protected $productListBrandConnectorToBrandProductFacadeBridge;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\BrandProduct\Business\BrandProductFacadeInterface
     */
    protected $brandProductFacadeInterfaceMock;

    /**
     * @var int
     */
    protected $idProductAbstract;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->brandProductFacadeInterfaceMock = $this->getMockBuilder(BrandProductFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->idProductAbstract = 1;

        $this->productListBrandConnectorToBrandProductFacadeBridge = new ProductListBrandConnectorToBrandProductFacadeBridge(
            $this->brandProductFacadeInterfaceMock
        );
    }

    /**
     * @return void
     */
    public function testGetBrandsByProductAbstractIds(): void
    {
        $this->assertInstanceOf(
            BrandCollectionTransfer::class,
            $this->productListBrandConnectorToBrandProductFacadeBridge->getBrandsByProductAbstractId(
                $this->idProductAbstract
            )
        );
    }
}
