<?php

namespace Training\Seller\Model\ResourceModel;

use Magento\Framework\EntityManager\EntityManager;
use Magento\Framework\EntityManager\MetadataPool;
use Magento\Framework\Model\ResourceModel\Db\Context;
use Magento\Framework\Stdlib\DateTime\DateTime;
use Training\Seller\Api\Data\SellerInterface;

class Seller extends AbstractDbResource
{

    /** @var DateTime */
    protected $dateTime;

    /**
     * Seller constructor.
     * @param Context $context
     * @param null|string $connectionName
     * @param MetadataPool $metadataPool
     * @param EntityManager $entityManager
     * @param DateTime $dateTime
     */
    public function __construct(
        Context $context,
        $connectionName,
        MetadataPool $metadataPool,
        EntityManager $entityManager,
        DateTime $dateTime
    ) {
        parent::__construct($context, $connectionName, $metadataPool, $entityManager, SellerInterface::class);
        $this->dateTime = $dateTime;
    }

    /**
     * @param \Magento\Framework\Model\AbstractModel $object
     * @param mixed $value
     * @param null $field
     * @return $this
     */
    public function load(\Magento\Framework\Model\AbstractModel $object, $value, $field = null)
    {
        return $this->loadWithEntityManager($object, $value, $field);
    }

    /**
     * @param \Magento\Framework\Model\AbstractModel $object
     * @return object
     */
    public function save(\Magento\Framework\Model\AbstractModel $object)
    {
        return $this->saveWithEntityManager($object);
    }
    
    /**
     * @param \Magento\Framework\Model\AbstractModel $object
     * @return bool
     */
    public function delete(\Magento\Framework\Model\AbstractModel $object)
    {
        return $this->deleteWithEntityManager($object);
    }

    /**
     * @param \Magento\Framework\Model\AbstractModel $object
     * @return $this
     */
    public function _beforeSave(\Magento\Framework\Model\AbstractModel $object)
    {
        $date = $this->dateTime->gmtDate();
        if ($object->getId() === null) {
            $object->setData(SellerInterface::CREATED_AT, $date);
        }
        $object->setData(SellerInterface::UPDATE_AT, $date);
        return parent::_beforeSave($object);
    }

    /**
     * @param int[] $ids
     * @return $this
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteIds($ids)
    {
        $condition = $this->getConnection()->quoteInto($this->getIdFieldName() . ' IN (?)', (array)$ids);
        $this->getConnection()->delete($this->getMainTable(), $condition);

        return $this;
    }

    /**
     * Resource initialization
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(SellerInterface::TABLE_NAME, SellerInterface::SELLER_ID);
    }
}