<?php

namespace Training\Helloworld\Controller\Product;

use Magento\Catalog\Model\Category;
use Magento\Catalog\Model\Product;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory as ProductCollectionFactory;
use Magento\Catalog\Model\ResourceModel\Category\CollectionFactory as CategoryCollectionFactory;
use Magento\CatalogUrlRewrite\Model\ResourceModel\Category\ProductCollection;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;

/**
 * Class Categories
 * @package Training\Helloworld\Controller\Product
 * @method Http getResponse()
 */
class Categories extends Action
{

    /** @var CollectionFactory */
    protected $productCollectionFactory;

    /** @var CategoryCollectionFactory */
    protected $categoryCollectionFactory;

    public function __construct(Context $context, ProductCollectionFactory $productCollectionFactory, CategoryCollectionFactory $categoryCollectionFactory)
    {
        parent::__construct($context);
        $this->productCollectionFactory = $productCollectionFactory;
        $this->categoryCollectionFactory = $categoryCollectionFactory;
    }

    public function execute()
    {
        $products = $this->productCollectionFactory->create();
        $products->addAttributeToFilter('name', ['like' => '%bag%'])
            ->addCategoryIds();

        $categoryIds = array();
        foreach ($products as $product) {
            /** @var Product $product */
            $categoryIds = array_merge($categoryIds, $product->getCategoryIds());
        }

        $categoryIds = array_unique($categoryIds);

        $categories = array();
        if (!empty($categoryIds)) {
            $categoriesCollection = $this->categoryCollectionFactory->create();
            $categoriesCollection->addAttributeToFilter('entity_id', ['in' => $categoryIds])
                ->addAttributeToSelect('name');

            foreach ($categoriesCollection as $category) {
                /** @var Category $category */
                $categories[$category->getId()] = $category->getName();
            }
        }

        foreach ($products as $product) {
            $this->getResponse()->appendBody($product->getName().'<br /><ul>');
$product->getCategoryCollection();
            foreach ($product->getCategoryIds() as $categoryId) {
                $this->getResponse()->appendBody('<li>'.$categories[$categoryId].'</li>');
            }

            $this->getResponse()->appendBody('</ul>');
        }

    }

}