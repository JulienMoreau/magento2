<?php

namespace Training\Seller\Api\Data;

/**
 * Interface SellerInterface
 * @package Training\Seller\Api\Data
 */
interface SellerInterface
{

    const TABLE_NAME = 'training_seller';

    const SELLER_ID = 'seller_id';
    const IDENTIFIER = 'identifier';
    const NAME = 'name';
    const CREATED_AT = 'created_at';
    const UPDATE_AT = 'update_at';

    /**
     * Get seller id
     *
     * @return int|null
     */
    public function getSellerId();

    /**
     * Set seller id
     *
     * @param int $sellerId
     * @return $this
     */
    public function setSellerId($sellerId);

    /**
     * Get identifier
     *
     * @return string
     */
    public function getIdentifier();

    /**
     * Set identifier
     *
     * @param string $identifier
     * @return $this
     */
    public function setIdentifier($identifier);

    /**
     * Get name
     *
     * @return string
     */
    public function getName();

    /**
     * Set name
     *
     * @param string $name
     * @return $this
     */
    public function setName($name);

    /**
     * Get created at
     *
     * @return string|null
     */
    public function getCreatedAt();

    /**
     * Set created at
     *
     * @param string|null $createdAt
     * @return $this
     */
    public function setCreatedAt($createdAt);

    /**
     * Get updated at
     *
     * @return string
     */
    public function getUpdateAt();

    /**
     * Set updated at
     *
     * @param string|null $updateAt
     * @return $this
     */
    public function setUpdateAt($updateAt);
}