<?php
/**
 * Created by PhpStorm.
 * User: formation
 * Date: 09/12/16
 * Time: 14:21
 */

namespace Training\Seller\Helper;


use Magento\Catalog\Api\Data\ProductInterface;
use Magento\Framework\Api\FilterBuilder;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Training\Seller\Api\Data\SellerInterface;
use Training\Seller\Api\SellerRepositoryInterface;

class Data extends AbstractHelper
{

    /**
     * @var SearchCriteriaBuilder
     */
    protected $_searchCriteriaBuilder;

    /**
     * @var SellerRepositoryInterface
     */
    protected $_sellerRepository;

    /**
     * @var FilterBuilder
     */
    protected $_filterBuilder;

    public function __construct(
        Context $context,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        SellerRepositoryInterface $sellerRepository,
        FilterBuilder $filterBuilder
    ) {
        parent::__construct($context);
        $this->_searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->_sellerRepository = $sellerRepository;
        $this->_filterBuilder = $filterBuilder;
    }

    /**
     * @param ProductInterface $product
     * @return array
     */
    public function getProductSellerIds(ProductInterface $product)
    {
        $sellerIds = $product->getTrainingSellerIds();

        return $sellerIds ? explode(',', $sellerIds) : [];
    }

    /**
     * @param array $sellerIds
     * @return \Magento\Framework\Api\SearchCriteria
     */
    public function getSearchCriteriaOnSellerIds(array $sellerIds)
    {
        $filters[] = $this->_filterBuilder
            ->setField(SellerInterface::FIELD_SELLER_ID)
            ->setConditionType('in')
            ->setValue($sellerIds)
            ->create();
        return $this->_searchCriteriaBuilder->addFilters($filters)->create();
    }

    /**
     * @param ProductInterface $productInterface
     * @return \Training\Seller\Api\Data\SellerInterface[]
     */
    public function getProductSellers(ProductInterface $productInterface)
    {
        $sellerIds = $this->getProductSellerIds($productInterface);
        if (!empty($sellerIds)) {
            return $this->_sellerRepository->getList($this->getSearchCriteriaOnSellerIds($sellerIds))->getItems();
        }

        return [];
    }

}