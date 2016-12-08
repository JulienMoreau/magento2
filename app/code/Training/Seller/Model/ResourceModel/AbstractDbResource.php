<?php

namespace Training\Seller\Model\ResourceModel;


use Magento\Framework\DB\Select;
use Magento\Framework\EntityManager\EntityManager;
use Magento\Framework\EntityManager\MetadataPool;
use Magento\Framework\Model\AbstractModel;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use Magento\Framework\Model\ResourceModel\Db\Context;

abstract class AbstractDbResource extends AbstractDb
{

    /** @var MetadataPool */
    protected $metadataPool;

    /** @var EntityManager */
    protected $entityManager;

    /** @var string */
    protected $entityType;

    /**
     * AbstractDbResource constructor.
     * @param Context $context
     * @param null|string $connectionName
     * @param MetadataPool $metadataPool
     * @param EntityManager $entityManager
     * @param $entityType
     */
    public function __construct(
        Context $context,
        MetadataPool $metadataPool,
        EntityManager $entityManager,
        $entityType,
        $connectionName = null
    ) {
        parent::__construct($context, $connectionName);
        $this->metadataPool = $metadataPool;
        $this->entityManager = $entityManager;
        $this->entityType = $entityType;
    }

    /**
     * @param AbstractModel $object
     * @param mixed $value
     * @param null|mixed $field
     * @return $this
     */
    public function loadWithEntityManager(AbstractModel $object, $value, $field = null)
    {
        $entityId = $this->getEntity($object, $value, $field);
        if ($entityId) {
            $this->entityManager->load($object, $entityId);
        }
        return $this;
    }

    /**
     * @param AbstractModel $object
     * @param mixed $value
     * @param mixed $field
     * @return bool|int|string
     * @throws \Exception
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    private function getEntity(AbstractModel $object, $value, $field)
    {
        $entityMetadata = $this->metadataPool->getMetadata($this->entityType);
        if (!is_numeric($value) && $field === null) {
            $field = 'identifier';
        } elseif (!$field) {
            $field = $entityMetadata->getIdentifierField();
        }
        $entityId = $value;
        if ($field != $entityMetadata->getIdentifierField()) {
            $select = $this->_getLoadSelect($field, $value, $object);
            $select->reset(Select::COLUMNS)
                ->columns($this->getMainTable() . '.' . $entityMetadata->getIdentifierField())
                ->limit(1);
            $result = $this->getConnection()->fetchCol($select);
            $entityId = count($result) ? $result[0] : false;
        }
        return $entityId;
    }

    /**
     * @return \Magento\Framework\DB\Adapter\AdapterInterface
     * @throws \Exception
     */
    public function getConnection()
    {
        return $this->metadataPool->getMetadata($this->entityType)->getEntityConnection();
    }

    /**
     * @param AbstractModel $object
     * @return object
     * @throws \Exception
     */
    public function saveWithEntityManager(AbstractModel $object)
    {
        return $this->entityManager->save($object);
    }

    /**
     * @param AbstractDb $object
     * @return bool
     * @throws \Exception
     */
    public function deleteWithEntityManager(AbstractModel $object)
    {
        return $this->entityManager->delete($object);
    }

}