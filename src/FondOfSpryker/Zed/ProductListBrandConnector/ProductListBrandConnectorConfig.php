<?php

namespace FondOfSpryker\Zed\ProductListBrandConnector;

use FondOfSpryker\Shared\ProductListBrandConnector\ProductListBrandConnectorConstants;
use Spryker\Zed\Kernel\AbstractBundleConfig;

class ProductListBrandConnectorConfig extends AbstractBundleConfig
{
    /**
     * @return string
     */
    public function getBrandProductAttribute()
    {
        return $this->get(ProductListBrandConnectorConstants::PRODUCT_ATTRIBUTE_BRAND, 'brand');
    }
}
