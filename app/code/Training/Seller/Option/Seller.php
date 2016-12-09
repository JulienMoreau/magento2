<?php
/**
 * Created by PhpStorm.
 * User: formation
 * Date: 09/12/16
 * Time: 11:34
 */

namespace Training\Seller\Option;


use Magento\Eav\Model\Entity\Attribute\Source\AbstractSource;
use Training\Seller\Model\ResourceModel\Seller\CollectionFactory;

class Seller extends AbstractSource
{

    /**
     * @var CollectionFactory
     */
    protected $collectionFactory;

    /**
     * @var array|null
     */
    protected static $options;

    /**
     * Seller constructor.
     * @param CollectionFactory $collectionFactory
     */
    public function __construct(CollectionFactory $collectionFactory)
    {
        $this->collectionFactory = $collectionFactory;
    }

    /**
     * @return array
     */
    protected function getOptions()
    {
        if (self::$options === null) {
            self::$options = $this->collectionFactory->create()->toOptionArray();
        }
        return self::$options;
    }

    /**
     * @return array
     */
    public function getAllOptions()
    {
        return $this->getOptions();
    }
}