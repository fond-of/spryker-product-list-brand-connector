<?php

namespace FondOfSpryker\Zed\ProductListBrandConnector\Business;

use Codeception\Test\Unit;
use FondOfSpryker\Zed\ProductListBrandConnector\Business\Expander\ProductListExpanderInterface;
use FondOfSpryker\Zed\ProductListBrandConnector\Business\Model\ProductListBrandRelationReaderInterface;
use Generated\Shared\Transfer\BrandRelationTransfer;
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
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\BrandRelationTransfer
     */
    protected $brandRelationTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\ProductListBrandConnector\Business\Expander\ProductListExpanderInterface
     */
    protected $productListExpanderMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\ProductListBrandConnector\Business\Model\ProductListBrandRelationReaderInterface
     */
    protected $productListBrandRelationReaderMock;

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

        $this->brandRelationTransferMock = $this->getMockBuilder(BrandRelationTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productListExpanderMock = $this->getMockBuilder(ProductListExpanderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productListBrandRelationReaderMock = $this->getMockBuilder(ProductListBrandRelationReaderInterface::class)
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
            ->willReturn($this->productListExpanderMock);

        $this->productListExpanderMock->expects($this->atLeastOnce())
            ->method('addBrandRelationToProductListTransfer')
            ->with($this->productListTransferMock)
            ->willReturn($this->productListTransferMock);

        $this->assertEquals(
            $this->productListTransferMock,
            $this->productListBrandConnectorFacade->addBrandRelationToProductList(
                $this->productListTransferMock
            )
        );
    }

    /**
     * @return void
     */
    public function testFindProductListBrandRelationByIdProductList(): void
    {
        $this->productListBrandConnectorBusinessFactoryMock->expects($this->atLeastOnce())
            ->method('createProductListBrandRelationReader')
            ->willReturn($this->productListBrandRelationReaderMock);

        $this->productListBrandRelationReaderMock->expects($this->atLeastOnce())
            ->method('findProductListBrandRelationByIdProductList')
            ->with($this->productListTransferMock)
            ->willReturn($this->brandRelationTransferMock);

        $this->assertEquals(
            $this->brandRelationTransferMock,
            $this->productListBrandConnectorFacade->findProductListBrandRelationByIdProductList(
                $this->productListTransferMock
            )
        );
    }
}
