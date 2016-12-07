<?php

namespace Training\Seller\Api;

use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Training\Seller\Api\Data\SellerInterface;
use Training\Seller\Api\Data\SellerSearchResultsInterface;

/**
 * Interface SellerRepositoryInterface
 * @package Training\Seller\Api
 */
interface SellerRepositoryInterface
{

    /**
     * Get a seller by id
     *
     * @param int $id
     * @return SellerInterface
     * @throws NoSuchEntityException
     */
    public function getById($id);

    /**
     * Get a seller by identifier
     *
     * @param string $identifier
     * @return SellerInterface
     * @throws NoSuchEntityException
     */
    public function getByIdentifier($identifier);

    /**
     * Get sellers
     *
     * @param SearchCriteriaInterface $searchCriteria
     * @return SellerSearchResultsInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria);

    /**
     * Save seller
     *
     * @param SellerInterface $seller
     * @return $this
     * @throws CouldNotSaveException
     */
    public function save(SellerInterface $seller);

    /**
     * Delete a seller by id
     *
     * @param int $id
     * @return bool
     * @throws NoSuchEntityException
     */
    public function deleteById($id);

    /**
     * Delete a seller by identifier
     *
     * @param string $identifier
     * @return bool
     * @throws NoSuchEntityException
     */
    public function deleteByIdentifier($identifier);
}