<?php
/**
 * Magento 2 Training Project
 * Module Training/Helloworld
 */
namespace Training\Helloworld\Controller\Product;

use Magento\Catalog\Model\Product;
use Magento\Catalog\Model\ProductFactory;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Response\Http;

/**
 * Action: Index/Index
 * @method Http getResponse()
 */
class Index extends Action
{

    /**
     * @var ProductFactory
     */
    protected $productFactaory;

    public function __construct(Context $context, ProductFactory $productFactory)
    {
        $this->productFactaory = $productFactory;
        parent::__construct($context);
    }

    /**
     * Execute the action
     *
     * @return void
     */
    public function execute()
    {
        /** @var Product $product */
        $product = $this->productFactaory->create()->load($this->getRequest()->getParam('id'));
        $this->getResponse()->appendBody($product->getName());
    }
}
