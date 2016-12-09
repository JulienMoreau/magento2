<?php
/**
 * Created by PhpStorm.
 * User: formation
 * Date: 09/12/16
 * Time: 11:22
 */

namespace Training\Seller\Setup;


use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\UpgradeSchemaInterface;
use Training\Seller\Api\Data\SellerInterface;

class UpgradeSchema implements UpgradeSchemaInterface
{

    /**
     * Upgrades DB schema for a module
     *
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     * @return void
     */
    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        if (version_compare($context->getVersion(), '1.0.1', '<')) {
            $setup->getConnection()->addColumn($setup->getTable(SellerInterface::TABLE_NAME),
                SellerInterface::FIELD_DESCRIPTION, [
                    'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    'length' => 255,
                    'nullable' => true,
                    'comment' => 'Description field'
                ]);
        }
    }
}