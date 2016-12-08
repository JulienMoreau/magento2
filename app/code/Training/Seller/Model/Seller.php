<?php

namespace Training\Seller\Model;


use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Model\AbstractModel;
use Training\Seller\Api\Data\SellerInterface;

class Seller extends AbstractModel implements IdentityInterface, SellerInterface
{

    const CACHE_TAG = 'training_seller';

    protected $_cacheTag = self::CACHE_TAG;

    public function _construct()
    {
        $this->_init(\Training\Seller\Model\ResourceModel\Seller::class);
    }

    /**
     * Return unique ID(s) for each object in system
     *
     * @return string[]
     */
    public function getIdentities()
    {
        return [self::CACHE_TAG . $this->getId(), self::CACHE_TAG . '_' . $this->getIdentifier()];
    }

    /**
     * Get seller id
     *
     * @return int|null
     */
    public function getSellerId()
    {
        return $this->getId();
    }

    /**
     * Set seller id
     *
     * @param int $sellerId
     * @return $this
     */
    public function setSellerId($sellerId)
    {
        $this->setId($sellerId);
        return $this;
    }

    /**
     * Get identifier
     *
     * @return string
     */
    public function getIdentifier()
    {
        return $this->getData(SellerInterface::IDENTIFIER);
    }

    /**
     * Set identifier
     *
     * @param string $identifier
     * @return $this
     */
    public function setIdentifier($identifier)
    {
        $this->setData(SellerInterface::IDENTIFIER, $identifier);
        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->getData(SellerInterface::NAME);
    }

    /**
     * Set name
     *
     * @param string $name
     * @return $this
     */
    public function setName($name)
    {
        $this->setData(SellerInterface::NAME, $name);
        return $this;
    }

    /**
     * Get created at
     *
     * @return string|null
     */
    public function getCreatedAt()
    {
        return $this->getData(SellerInterface::CREATED_AT);
    }

    /**
     * Set created at
     *
     * @param string|null $createdAt
     * @return $this
     */
    public function setCreatedAt($createdAt)
    {
        $this->setData(SellerInterface::CREATED_AT, $createdAt);
        return $this;
    }

    /**
     * Get updated at
     *
     * @return string
     */
    public function getUpdateAt()
    {
        return $this->getData(SellerInterface::UPDATE_AT);
    }

    /**
     * Set updated at
     *
     * @param string|null $updateAt
     * @return $this
     */
    public function setUpdateAt($updateAt)
    {
        $this->setData(SellerInterface::UPDATE_AT, $updateAt);
        return $this;
    }
}