<?php

namespace FondOfSpryker\Zed\ProductListBrandConnector;

use Codeception\Test\Unit;
use Spryker\Shared\Config\Config;

class ProductListBrandConnectorConfigTest extends Unit
{
    /**
     * @var \FondOfSpryker\Zed\ProductListBrandConnector\ProductListBrandConnectorConfig
     */
    protected $productListBrandConnectorConfig;

    /**
     * @var string
     */
    protected $brandProductAttribute;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Shared\Config\Config
     */
    protected $configMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->brandProductAttribute = 'brand-product-attribute';

        $this->configMock = $this->getMockBuilder(Config::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productListBrandConnectorConfig = new class (
            $this->brandProductAttribute
        ) extends ProductListBrandConnectorConfig {
            /**
             * @var string
             */
            protected $brandProductAttribute;

            /**
             * @param string $brandProductAttribute
             */
            public function __construct(string $brandProductAttribute)
            {
                $this->brandProductAttribute = $brandProductAttribute;
            }

            /**
             * @param string $key
             * @param string|null $default
             *
             * @return string
             */
            protected function get($key, $default = null): string
            {
                return $this->brandProductAttribute;
            }
        };
    }

    /**
     * @return void
     */
    public function testGetBrandProductAttribute(): void
    {
        $this->assertSame(
            $this->brandProductAttribute,
            $this->productListBrandConnectorConfig->getBrandProductAttribute()
        );
    }
}
