<?php

namespace Training\Seller\Api\Data;


use Magento\Framework\Api\SearchResultsInterface;

interface SellerSearchResultsInterface extends SearchResultsInterface
{

    /**
     * Set sellers
     *
     * @param SellerInterface[] $items
     * @return $this
     */
    public function setItems(array $items);

    /**
     * Get sellers
     *
     * @return SellerInterface[]
     */
    public function getItems();

}