<?php

namespace FondOfSpryker\Zed\ProductListBrandConnector\Business\Expander;

use ArrayObject;
use Codeception\Test\Unit;
use FondOfSpryker\Zed\ProductListBrandConnector\Dependency\Facade\ProductListBrandConnectorToBrandProductFacadeInterface;
use FondOfSpryker\Zed\ProductListBrandConnector\Dependency\Facade\ProductListBrandConnectorToProductListFacadeInterface;
use Generated\Shared\Transfer\BrandCollectionTransfer;
use Generated\Shared\Transfer\BrandTransfer;
use Generated\Shared\Transfer\ProductListTransfer;

class ProductListExpanderTest extends Unit
{
    /**
     * @var \FondOfSpryker\Zed\ProductListBrandConnector\Business\Expander\ProductListExpander
     */
    protected $productListExpander;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\ProductListBrandConnector\Dependency\Facade\ProductListBrandConnectorToBrandProductFacadeInterface
     */
    protected $productListBrandConnectorToBrandProductFacadeInterfaceMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\ProductListBrandConnector\Dependency\Facade\ProductListBrandConnectorToProductListFacadeInterface
     */
    protected $productListBrandConnectorToProductListFacadeInterfaceMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ProductListTransfer
     */
    protected $productListTransferMock;

    /**
     * @var int
     */
    protected $idProductList;

    /**
     * @var int
     */
    protected $idAbstractProductList;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\BrandCollectionTransfer
     */
    protected $brandCollectionTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\BrandTransfer
     */
    protected $brandTransferMock;

    /**
     * @var \ArrayObject|\Generated\Shared\Transfer\BrandTransfer[]
     */
    protected $brands;

    /**
     * @var int
     */
    protected $idBrand;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->productListBrandConnectorToBrandProductFacadeInterfaceMock = $this->getMockBuilder(ProductListBrandConnectorToBrandProductFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productListBrandConnectorToProductListFacadeInterfaceMock = $this->getMockBuilder(ProductListBrandConnectorToProductListFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productListTransferMock = $this->getMockBuilder(ProductListTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->idProductList = 1;

        $this->idAbstractProductList = 2;

        $this->brandCollectionTransferMock = $this->getMockBuilder(BrandCollectionTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->brandTransferMock = $this->getMockBuilder(BrandTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->brands = new ArrayObject([
            $this->brandTransferMock,
        ]);

        $this->idBrand = 1;

        $this->productListExpander = new ProductListExpander(
            $this->productListBrandConnectorToBrandProductFacadeInterfaceMock,
            $this->productListBrandConnectorToProductListFacadeInterfaceMock
        );
    }

    /**
     * @return void
     */
    public function testAddBrandRelationToProductListTransfer(): void
    {
        $this->productListTransferMock->expects($this->atLeastOnce())
            ->method('getIdProductList')
            ->willReturn($this->idProductList);

        $this->productListBrandConnectorToProductListFacadeInterfaceMock->expects($this->atLeastOnce())
            ->method('getProductAbstractIdsByProductListIds')
            ->willReturn([$this->idAbstractProductList]);

        $this->productListBrandConnectorToBrandProductFacadeInterfaceMock->expects($this->atLeastOnce())
            ->method('getBrandsByProductAbstractId')
            ->with($this->idAbstractProductList)
            ->willReturn($this->brandCollectionTransferMock);

        $this->brandCollectionTransferMock->expects($this->atLeastOnce())
            ->method('getBrands')
            ->willReturn($this->brands);

        $this->brandTransferMock->expects($this->atLeastOnce())
            ->method('getIdBrand')
            ->willReturn($this->idBrand);

        $this->productListTransferMock->expects($this->atLeastOnce())
            ->method('setBrandRelation')
            ->willReturnSelf();

        $this->assertInstanceOf(
            ProductListTransfer::class,
            $this->productListExpander->addBrandRelationToProductListTransfer(
                $this->productListTransferMock
            )
        );
    }
}
