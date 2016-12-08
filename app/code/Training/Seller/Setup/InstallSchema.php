<?php

namespace Training\Seller\Setup;


use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Training\Seller\Api\Data\SellerInterface;

class InstallSchema implements InstallSchemaInterface
{

    /**
     * Installs DB schema for a module
     *
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     * @return void
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $table = $setup->getConnection()
            ->newTable($setup->getTable(SellerInterface::TABLE_NAME))
            ->addColumn(SellerInterface::SELLER_ID, Table::TYPE_INTEGER, null, [
                'identity' => true,
                'unsigned' => true,
                'nullable' => false,
                'primary' => true
            ], 'Seller id')
            ->addColumn(SellerInterface::IDENTIFIER, Table::TYPE_TEXT, 255, [], 'Seller identifier')
            ->addColumn(SellerInterface::NAME, Table::TYPE_TEXT, 255, [], 'Seller name')
            ->addColumn(SellerInterface::CREATED_AT, Table::TYPE_DATETIME, null, [], 'Created at')
            ->addColumn(SellerInterface::UPDATE_AT, Table::TYPE_DATETIME, null, [], 'Updated at')
            ->addIndex($setup->getIdxName(SellerInterface::TABLE_NAME, SellerInterface::IDENTIFIER),
                SellerInterface::IDENTIFIER);

        $setup->getConnection()->createTable($table);
    }
}