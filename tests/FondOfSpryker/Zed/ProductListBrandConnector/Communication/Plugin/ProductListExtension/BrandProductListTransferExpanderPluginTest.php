<?php

namespace FondOfSpryker\Zed\ProductListBrandConnector\Communication\Plugin\ProductListExtension;

use Codeception\Test\Unit;
use FondOfSpryker\Zed\ProductListBrandConnector\Business\ProductListBrandConnectorFacade;
use Generated\Shared\Transfer\ProductListTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

class BrandProductListTransferExpanderPluginTest extends Unit
{
    /**
     * @var \FondOfSpryker\Zed\ProductListBrandConnector\Communication\Plugin\ProductListExtension\BrandProductListTransferExpanderPlugin
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
        $this->productListBrandConnectorFacadeInterfaceMock = $this->getMockBuilder(ProductListBrandConnectorFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productListTransferMock = $this->getMockBuilder(ProductListTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->brandProductListTransferExpanderPlugin = new class (
            $this->productListBrandConnectorFacadeInterfaceMock
        ) extends BrandProductListTransferExpanderPlugin {
            /**
             * @var \FondOfSpryker\Zed\ProductListBrandConnector\Business\ProductListBrandConnectorFacade
             */
            protected $productListBrandConnectorFacade;

            /**
             * @param \FondOfSpryker\Zed\ProductListBrandConnector\Business\ProductListBrandConnectorFacade $productListBrandConnectorFacade
             */
            public function __construct(ProductListBrandConnectorFacade $productListBrandConnectorFacade)
            {
                $this->productListBrandConnectorFacade = $productListBrandConnectorFacade;
            }

            /**
             * @return \Spryker\Zed\Kernel\Business\AbstractFacade
             */
            protected function getFacade(): AbstractFacade
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
