<?php

namespace Training\Seller\Setup;


use Magento\Catalog\Model\Product;
use Magento\ConfigurableProduct\Model\Product\Type\Configurable;
use Magento\Customer\Model\Customer;
use Magento\Customer\Setup\CustomerSetup;
use Magento\Customer\Setup\CustomerSetupFactory;
use Magento\Eav\Model\Config;
use Magento\Eav\Model\Entity\Attribute\Backend\ArrayBackend;
use Magento\Eav\Setup\EavSetup;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\UpgradeDataInterface;
use Training\Seller\Option\Seller;

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
     * @var EavSetupFactory
     */
    protected $eavSetupFactory;

    /**
     * UpgradeSchema constructor.
     * @param CustomerSetupFactory $eavSetupFactory
     */
    public function __construct(
        CustomerSetupFactory $customerSetupFactory,
        Config $config,
        EavSetupFactory $eavSetupFactory
    )
    {
        $this->customerSetupFactory = $customerSetupFactory;
        $this->config = $config;
        $this->eavSetupFactory = $eavSetupFactory;
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

        if (version_compare($context->getVersion(), '1.0.3', '<')) {
            /** @var EavSetup $eavSetup */
            $eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);
            $eavSetup->removeAttribute(Product::ENTITY, 'training_seller_ids');
            $eavSetup->addAttribute(Product::ENTITY, 'training_seller_ids', [
                'label' => 'Training Sellers',
                'type' => 'varchar',
                'input' => 'multiselect',
                'backend' => \Magento\Eav\Model\Entity\Attribute\Backend\ArrayBackend::class,
                'frontend' => '',
                'class' => '',
                'source' => \Training\Seller\Option\Seller::class,
                'global' => \Magento\Catalog\Model\ResourceModel\Eav\Attribute::SCOPE_GLOBAL,
                'visible' => true,
                'required' => false,
                'user_defined' => true,
                'default' => '',
                'searchable' => false,
                'filterable' => false,
                'comparable' => true,
                'visible_on_front' => true,
                'used_in_product_listing' => false,
                'is_html_allowed_on_front' => true,
                'unique' => false,
                'apply_to' => 'simple,configurable'
            ]);

            $eavSetup->addAttributeGroup(
                Product::ENTITY,
                'bag',
                'Training'
            );

            $eavSetup->addAttributeToGroup(
                Product::ENTITY,
                'bag',
                'Training',
                'training_seller_ids'
            );

            $this->config->clear();
        }

        $setup->endSetup();
    }
}