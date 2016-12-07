<?php
/**
 * Created by PhpStorm.
 * User: formation
 * Date: 07/12/16
 * Time: 18:10
 */

namespace Training\Seller\Model\ResourceModel\Seller;


use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Training\Seller\Api\Data\SellerInterface;
use Training\Seller\Model\Seller;

class Collection extends AbstractCollection
{

    public function _construct()
    {
        $this->_init(Seller::class, \Training\Seller\Model\ResourceModel\Seller::class);
    }

    /**
     * @return array
     */
    public function toOptionArray()
    {
        return parent::_toOptionArray(SellerInterface::SELLER_ID, SellerInterface::NAME);
    }

}