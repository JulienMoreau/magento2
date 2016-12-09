<?php
/**
 * Created by PhpStorm.
 * User: formation
 * Date: 09/12/16
 * Time: 14:38
 */

namespace Training\Seller\Block\Product;


use Magento\Catalog\Api\Data\ProductInterface;
use Magento\Catalog\Model\Product;
use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Registry;
use Magento\Framework\View\Element\Template\Context;
use Training\Seller\Api\SellerRepositoryInterface;
use Training\Seller\Block\Seller\AbstractBlock;
use Training\Seller\Helper\Data;
use Training\Seller\Helper\Url as UrlHelper;
use Training\Seller\Model\Seller;

class Sellers extends AbstractBlock implements IdentityInterface
{

    static protected $_sellers;

    /**.
     * @var SellerRepositoryInterface
     */
    protected $_sellerRepository;
    /**
     * @var Data
     */
    protected $_dataHelper;

    public function __construct(
        Context $context,
        Registry $registry,
        UrlHelper $urlHelper,
        array $data,
        SellerRepositoryInterface $sellerRepository,
        Data $dataHelper
    ) {
        parent::__construct($context, $registry, $urlHelper, $data);
        $this->_sellerRepository = $sellerRepository;
        $this->_dataHelper = $dataHelper;
    }

    /**
     * Return unique ID(s) for each object in system
     *
     * @return string[]
     */
    public function getIdentities()
    {
        $identities = [];

        /** @var Product $product */
        $product = $this->getCurrentProduct();
        if ($product) {
            $identities = array_merge($identities, $product->getIdentities());

            /** @var Seller $seller */
            foreach ($this->getProductSellers() as $seller) {
                $identities = array_merge($identities, $seller->getIdentities());
            }

        }

        return $identities;
    }

    /**
     * @return ProductInterface|null
     */
    public function getCurrentProduct()
    {
        return $this->registry->registry('current_product') instanceof ProductInterface ? $this->registry->registry('current_product') : null;
    }

    /**
     * @return \Training\Seller\Api\Data\SellerInterface[]
     */
    public function getProductSellers()
    {
        $product = $this->getCurrentProduct();
        if (!$product || $product->getId() === null) {
            return [];
        }

        if (!isset(self::$_sellers[$product->getId()])) {
            self::$_sellers[$product->getId()] = $this->_dataHelper->getProductSellers($product);
        }

        return self::$_sellers[$product->getId()];
    }


    public function _construct()
    {
        $product = $this->getCurrentProduct();
        if ($product) {
            $this->setData('cache_key', 'product_view_tab_sellers_' . $product->getId());
        }
    }
}