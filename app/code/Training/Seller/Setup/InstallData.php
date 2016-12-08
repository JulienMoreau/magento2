<?php
/**
 * Created by PhpStorm.
 * User: formation
 * Date: 08/12/16
 * Time: 10:28
 */

namespace Training\Seller\Setup;


use Magento\Framework\ObjectManagerInterface;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Training\Seller\Model\Seller;
use Training\Seller\Model\SellerFactory;

class InstallData implements InstallDataInterface
{

    /** @var ObjectManagerInterface */
    protected $sellerFactory;

    public function __construct(SellerFactory $sellerFactory)
    {
        $this->sellerFactory = $sellerFactory;
    }

    /**
     * Installs data for a module
     *
     * @param ModuleDataSetupInterface $setup
     * @param ModuleContextInterface $context
     * @return void
     */
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        /** @var Seller $seller */
        $seller = $this->sellerFactory->create();
        $seller->setIdentifier('main')
            ->setName('main');
        $seller->getResource()->save($seller);
    }
}