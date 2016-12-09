<?php
/**
 * Created by PhpStorm.
 * User: formation
 * Date: 09/12/16
 * Time: 15:40
 */

namespace Training\Seller\Plugin;


use Magento\Catalog\Api\Data\ProductExtensionFactory;
use Training\Seller\Helper\Data;

class Product
{

    /**
     * @var Data
     */
    protected $_dataHelper;

    /**
     * @var ProductExtensionFactory
     */
    protected $_productExtensionFactory;

    /**
     * Product constructor.
     * @param Data $dataHelper
     * @param ProductExtensionFactory $productExtensionFactory
     */
    public function __construct(Data $dataHelper, ProductExtensionFactory $productExtensionFactory)
    {
        $this->_dataHelper = $dataHelper;
        $this->_productExtensionFactory = $productExtensionFactory;
    }

    /**
     * @param \Magento\Catalog\Model\Product $product
     * @return \Magento\Catalog\Model\Product
     */
    public function afterLoad(\Magento\Catalog\Model\Product $product)
    {
        $productExtension = $product->getExtensionAttributes();
        if ($productExtension === null) {
            $productExtension = $this->_productExtensionFactory->create();
        }
        $productExtension->setData('sellers', $this->_dataHelper->getProductSellers($product));
        $product->setExtensionAttributes($productExtension);
        return $product;
    }

}