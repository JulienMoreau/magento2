<?php

namespace Training\Helloworld\Controller\Product;

use Magento\Catalog\Api\Data\ProductInterface;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Framework\Api\FilterBuilder;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Api\SortOrder;
use Magento\Framework\Api\SortOrderBuilder;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;

class Search extends Action
{
    /** @var ProductRepositoryInterface */
    protected $productRepository;

    /** @var SearchCriteriaBuilder */
    protected $searchCriteriaBuilder;

    /** @var FilterBuilder */
    protected $filterBuilder;

    /** @var SortOrderBuilder */
    protected $sortOrderBuilder;

    public function __construct(
        Context $context,
        ProductRepositoryInterface $productRepository,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        FilterBuilder $filterBuilder,
        SortOrderBuilder $sortOrderBuilder
    ) {
        parent::__construct($context);
        $this->productRepository = $productRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->filterBuilder = $filterBuilder;
        $this->sortOrderBuilder = $sortOrderBuilder;
    }

    public function execute()
    {
        $filterDescription[] = $this->filterBuilder
            ->setField('description')
            ->setConditionType('like')
            ->setValue('%comfortable%')
            ->create();

        $filterName[] = $this->filterBuilder
            ->setField(ProductInterface::NAME)
            ->setConditionType('like')
            ->setValue('%bruno%')
            ->create();

        $sortOrder = $this->sortOrderBuilder
            ->setField(ProductInterface::NAME)
            ->setDirection(SortOrder::SORT_DESC)
            ->create();

        $searchCriteria = $this->searchCriteriaBuilder
            ->addFilters($filterDescription)
            ->addFilters($filterName)
            ->addSortOrder($sortOrder)
            ->setPageSize(6)
            ->create();

        foreach ($this->productRepository->getList($searchCriteria)->getItems() as $product) {
            $this->getResponse()->appendBody($product->getName().'<br />');
        }
    }

}