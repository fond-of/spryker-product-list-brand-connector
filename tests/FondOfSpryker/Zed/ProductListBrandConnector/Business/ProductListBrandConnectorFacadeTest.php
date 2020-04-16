<?php

namespace FondOfSpryker\Zed\ProductListBrandConnector\Business;

use Codeception\Test\Unit;
use FondOfSpryker\Zed\ProductListBrandConnector\Business\Expander\ProductListExpanderInterface;
use Generated\Shared\Transfer\ProductListTransfer;

class ProductListBrandConnectorFacadeTest extends Unit
{
    /**
     * @var \FondOfSpryker\Zed\ProductListBrandConnector\Business\ProductListBrandConnectorFacade
     */
    protected $productListBrandConnectorFacade;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\ProductListBrandConnector\Business\ProductListBrandConnectorBusinessFactory
     */
    protected $productListBrandConnectorBusinessFactoryMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ProductListTransfer
     */
    protected $productListTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\ProductListBrandConnector\Business\Expander\ProductListExpanderInterface
     */
    protected $productListExpanderInterfaceMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->productListBrandConnectorBusinessFactoryMock = $this->getMockBuilder(ProductListBrandConnectorBusinessFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productListTransferMock = $this->getMockBuilder(ProductListTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productListExpanderInterfaceMock = $this->getMockBuilder(ProductListExpanderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productListBrandConnectorFacade = new ProductListBrandConnectorFacade();
        $this->productListBrandConnectorFacade->setFactory($this->productListBrandConnectorBusinessFactoryMock);
    }

    /**
     * @return void
     */
    public function testAddBrandRelationToProductList(): void
    {
        $this->productListBrandConnectorBusinessFactoryMock->expects($this->atLeastOnce())
            ->method('createProductListExpander')
            ->willReturn($this->productListExpanderInterfaceMock);

        $this->productListExpanderInterfaceMock->expects($this->atLeastOnce())
            ->method('addBrandRelationToProductListTransfer')
            ->with($this->productListTransferMock)
            ->willReturn($this->productListTransferMock);

        $this->assertInstanceOf(
            ProductListTransfer::class,
            $this->productListBrandConnectorFacade->addBrandRelationToProductList(
                $this->productListTransferMock
            )
        );
    }
}
