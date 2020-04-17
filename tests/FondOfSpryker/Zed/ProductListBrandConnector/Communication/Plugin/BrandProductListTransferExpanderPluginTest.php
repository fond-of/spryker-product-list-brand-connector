<?php

namespace FondOfSpryker\Zed\ProductListBrandConnector\Communication\Plugin;

use Codeception\Test\Unit;
use FondOfSpryker\Zed\ProductListBrandConnector\Business\ProductListBrandConnectorFacadeInterface;
use Generated\Shared\Transfer\ProductListTransfer;

class BrandProductListTransferExpanderPluginTest extends Unit
{
    /**
     * @var \FondOfSpryker\Zed\ProductListBrandConnector\Communication\Plugin\BrandProductListTransferExpanderPlugin
     */
    protected $brandProductListTransferExpanderPlugin;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\ProductListBrandConnector\Business\ProductListBrandConnectorFacadeInterface
     */
    protected $productListBrandConnectorFacadeInterfaceMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ProductListTransfer
     */
    protected $productListTransferMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->productListBrandConnectorFacadeInterfaceMock = $this->getMockBuilder(ProductListBrandConnectorFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productListTransferMock = $this->getMockBuilder(ProductListTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->brandProductListTransferExpanderPlugin = new class (
            $this->productListBrandConnectorFacadeInterfaceMock
        ) extends BrandProductListTransferExpanderPlugin {
            /**
             * @var \FondOfSpryker\Zed\ProductListBrandConnector\Business\ProductListBrandConnectorFacadeInterface
             */
            protected $productListBrandConnectorFacade;

            /**
             * @param \FondOfSpryker\Zed\ProductListBrandConnector\Business\ProductListBrandConnectorFacadeInterface $productListBrandConnectorFacade
             */
            public function __construct(ProductListBrandConnectorFacadeInterface $productListBrandConnectorFacade)
            {
                $this->productListBrandConnectorFacade = $productListBrandConnectorFacade;
            }

            /**
             * @return \FondOfSpryker\Zed\ProductListBrandConnector\Business\ProductListBrandConnectorFacadeInterface
             */
            public function getFacade(): ProductListBrandConnectorFacadeInterface
            {
                return $this->productListBrandConnectorFacade;
            }
        };
    }

    /**
     * @return void
     */
    public function testExpandTransfer(): void
    {
        $this->productListBrandConnectorFacadeInterfaceMock->expects($this->atLeastOnce())
            ->method('addBrandRelationToProductList')
            ->with($this->productListTransferMock)
            ->willReturn($this->productListTransferMock);

        $this->assertInstanceOf(
            ProductListTransfer::class,
            $this->brandProductListTransferExpanderPlugin->expandTransfer(
                $this->productListTransferMock
            )
        );
    }
}
