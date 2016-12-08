<?php

namespace Training\Seller\Model\Repository;

use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Training\Seller\Api\Data\SellerInterface;
use Training\Seller\Api\Data\SellerSearchResultsInterface;
use Training\Seller\Api\SellerRepositoryInterface;

class Seller extends AbstractRepository implements SellerRepositoryInterface
{


    public function __construct(
        \Training\Seller\Model\SellerFactory $objectFactory,
        \Training\Seller\Model\ResourceModel\Seller $objectResource,
        \Training\Seller\Api\Data\SellerSearchResultsInterfaceFactory $searchResultsFactory
    ) {
        parent::__construct($objectFactory, $objectResource, $searchResultsFactory);
        $this->setIdentifierFieldName(SellerInterface::IDENTIFIER);
    }

    /**
     * Get sellers
     *
     * @param SearchCriteriaInterface $searchCriteria
     * @return SellerSearchResultsInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria)
    {
        return $this->getEntities($searchCriteria);
    }

    /**
     * Save seller
     *
     * @param SellerInterface $seller
     * @return $this
     * @throws CouldNotSaveException
     */
    public function save(SellerInterface $seller)
    {
        /** @noinspection PhpParamsInspection */
        return $this->saveEntity($seller);
    }

    /**
     * Delete a seller by id
     *
     * @param int $id
     * @return bool
     * @throws NoSuchEntityException
     * @SuppressWarnings
     */
    public function deleteById($id)
    {
        return $this->deleteEntity($this->getById($id));
    }

    /**
     * Get a seller by id
     *
     * @param int $id
     * @return SellerInterface
     * @throws NoSuchEntityException
     */
    public function getById($id)
    {
        return $this->getEntityById($id);
    }

    /**
     * Delete a seller by identifier
     *
     * @param string $identifier
     * @return bool
     * @throws NoSuchEntityException
     */
    public function deleteByIdentifier($identifier)
    {
        /** @noinspection PhpParamsInspection */
        return $this->deleteEntity($this->getByIdentifier($identifier));
    }

    /**
     * Get a seller by identifier
     *
     * @param string $identifier
     * @return SellerInterface
     * @throws NoSuchEntityException
     */
    public function getByIdentifier($identifier)
    {
        return $this->getEntityByIdentifier($identifier);
    }
}