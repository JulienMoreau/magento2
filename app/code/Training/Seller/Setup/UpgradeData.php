<?php

namespace Training\Seller\Setup;


use Magento\Customer\Model\Customer;
use Magento\Customer\Setup\CustomerSetup;
use Magento\Customer\Setup\CustomerSetupFactory;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\UpgradeDataInterface;
use Training\Seller\Option\Seller;
use Magento\Eav\Model\Config;

class UpgradeData implements UpgradeDataInterface
{

    /**
     * @var CustomerSetupFactory
     */
    protected $customerSetupFactory;

    /**
     * @var Config
     */
    protected $config;

    /**
     * UpgradeSchema constructor.
     * @param CustomerSetupFactory $eavSetupFactory
     */
    public function __construct(CustomerSetupFactory $customerSetupFactory, Config $config)
    {
        $this->customerSetupFactory = $customerSetupFactory;
        $this->config = $config;
    }

    /**
     * Upgrades data for a module
     *
     * @param ModuleDataSetupInterface $setup
     * @param ModuleContextInterface $context
     * @return void
     */
    public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        if (version_compare($context->getVersion(), '1.0.2', '<')) {
            /** @var CustomerSetup $customerSetup */
            $customerSetup = $this->customerSetupFactory->create(['setup' => $setup]);
            $customerSetup->addAttribute(Customer::ENTITY, 'training_seller_id', [
                'type' => 'int',
                'label' => 'Seller id',
                'input' => 'select',
                'required' => false,
                'system'   => false,
                'source' => Seller::class
            ]);

            $this->config->clear();

            $attribute = $customerSetup->getEavConfig()->getAttribute('customer', 'training_seller_id');
            $attribute->setData('used_in_forms', ['adminhtml_customer']);
            $attribute->save();

            $this->config->clear();
        }

        $setup->endSetup();
    }
}