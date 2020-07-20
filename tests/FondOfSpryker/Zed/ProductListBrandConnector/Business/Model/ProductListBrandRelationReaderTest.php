<?php

namespace FondOfSpryker\Zed\ProductListBrandConnector\Business\Model;

use Codeception\Test\Unit;
use FondOfSpryker\Zed\ProductListBrandConnector\Dependency\Facade\ProductListBrandConnectorToBrandProductFacadeInterface;
use FondOfSpryker\Zed\ProductListBrandConnector\Dependency\Facade\ProductListBrandConnectorToProductListFacadeInterface;
use Generated\Shared\Transfer\BrandCollectionTransfer;
use Generated\Shared\Transfer\BrandTransfer;
use Generated\Shared\Transfer\ProductListTransfer;

class ProductListBrandRelationReaderTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\ProductListBrandConnector\Dependency\Facade\ProductListBrandConnectorToProductListFacadeInterface
     */
    protected $productListFacadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\ProductListBrandConnector\Dependency\Facade\ProductListBrandConnectorToBrandProductFacadeInterface
     */
    protected $brandProductFacadeMock;

    /**
     * @var \Generated\Shared\Transfer\ProductListTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $productListTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\BrandCollectionTransfer
     */
    protected $brandCollectionTransferMock;

    /**
     * @var \Generated\Shared\Transfer\BrandTransfer[]|\PHPUnit\Framework\MockObject\MockObject[]
     */
    protected $brandTransferMocks;

    /**
     * @var int
     */
    protected $idProductList;

    /**
     * @var int[]
     */
    protected $productAbstractIds;

    /**
     * @var int
     */
    protected $idBrand;

    /**
     * @var \FondOfSpryker\Zed\ProductListBrandConnector\Business\Model\ProductListBrandRelationReader
     */
    protected $productListBrandRelationReader;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->productListFacadeMock = $this->getMockBuilder(ProductListBrandConnectorToProductListFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->brandProductFacadeMock = $this->getMockBuilder(ProductListBrandConnectorToBrandProductFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productListTransferMock = $this->getMockBuilder(ProductListTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->brandCollectionTransferMock = $this->getMockBuilder(BrandCollectionTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->brandTransferMocks = [
            $this->getMockBuilder(BrandTransfer::class)
                ->disableOriginalConstructor()
                ->getMock(),
        ];

        $this->idProductList = 1;
        $this->productAbstractIds = [1, 2];
        $this->idBrand = 1;

        $this->productListBrandRelationReader = new ProductListBrandRelationReader(
            $this->brandProductFacadeMock,
            $this->productListFacadeMock
        );
    }

    /**
     * @return void
     */
    public function testFindProductListBrandRelationByIdProductList(): void
    {
        $this->productListTransferMock->expects($this->atLeastOnce())
            ->method('getIdProductList')
            ->willReturn($this->idProductList);

        $this->productListFacadeMock->expects($this->atLeastOnce())
            ->method('getProductAbstractIdsByProductListIds')
            ->with([$this->idProductList])
            ->willReturn($this->productAbstractIds);

        $this->brandProductFacadeMock->expects($this->atLeastOnce())
            ->method('getBrandsByProductAbstractId')
            ->withConsecutive([$this->productAbstractIds[0]], [$this->productAbstractIds[1]])
            ->willReturn($this->brandCollectionTransferMock);

        $this->brandCollectionTransferMock->expects($this->atLeastOnce())
            ->method('getBrands')
            ->willReturn($this->brandTransferMocks);

        $this->brandTransferMocks[0]->expects($this->atLeastOnce())
            ->method('getIdBrand')
            ->willReturn($this->idBrand);

        $brandRelationTransfer = $this->productListBrandRelationReader
            ->findProductListBrandRelationByIdProductList($this->productListTransferMock);

        $this->assertEquals([$this->idBrand], $brandRelationTransfer->getIdBrands());
        $this->assertEquals($this->idProductList, $brandRelationTransfer->getIdProductList());
    }
}
