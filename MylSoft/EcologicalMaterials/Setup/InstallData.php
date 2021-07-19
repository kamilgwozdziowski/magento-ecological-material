<?php

namespace MylSoft\EcologicalMaterials\Setup;

use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Catalog\Model\Product;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface;

/**
 * Class InstallData
 * @package MylSoft\EcologicalMaterials\Setup
 */
class InstallData implements InstallDataInterface
{
    /**
     * Eav setup factory
     * @var EavSetupFactory
     */
    private $eavSetupFactory;

    /**
     * Init
     * @param EavSetupFactory $eavSetupFactory
     */
    public function __construct(EavSetupFactory $eavSetupFactory)
    {
        $this->eavSetupFactory = $eavSetupFactory;
    }

    /**
     * @param ModuleDataSetupInterface $setup
     * @param ModuleContextInterface $context
     */
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $eavSetup = $this->eavSetupFactory->create();

        $newAttribute = [
            'delivery_time_min' => [
                'group' => 'General',
                'type' => 'int',
                'label' => 'Delivery Time Min',
                'input' => 'input',
                'backend' => 'MylSoft\EcologicalMaterials\Model\Attribute\Backend\DeliveryTimeMin',
                'required' => true,
                'sort_order' => 10,
                'global' => ScopedAttributeInterface::SCOPE_GLOBAL,
                'is_used_in_grid' => false,
                'is_visible_in_grid' => false,
                'is_filterable_in_grid' => false,
                'visible' => true,
                'is_html_allowed_on_front' => false,
                'visible_on_front' => true
            ],
            'delivery_time_max' => [
                'group' => 'General',
                'type' => 'int',
                'label' => 'Delivery Time Max',
                'input' => 'input',
                'backend' => 'MylSoft\EcologicalMaterials\Model\Attribute\Backend\DeliveryTimeMax',
                'required' => true,
                'sort_order' => 10,
                'global' => ScopedAttributeInterface::SCOPE_GLOBAL,
                'is_used_in_grid' => false,
                'is_visible_in_grid' => false,
                'is_filterable_in_grid' => false,
                'visible' => true,
                'is_html_allowed_on_front' => false,
                'visible_on_front' => true
            ],
            'material' => [
                'group' => 'General',
                'type' => 'varchar',
                'label' => 'Material',
                'input' => 'select',
                'required' => false,
                'sort_order' => 10,
                'source' => 'MylSoft\EcologicalMaterials\Model\Attribute\Source\Material',
                'global' => ScopedAttributeInterface::SCOPE_GLOBAL,
                'is_used_in_grid' => false,
                'is_visible_in_grid' => false,
                'is_filterable_in_grid' => true,
                'visible' => true,
                'is_html_allowed_on_front' => false,
                'visible_on_front' => true,
                'filterable' => true,
                'used_in_product_listing' => true,
                'apply_to' => 'simple'
            ],
            'ecological' => [
                'group' => 'General',
                'type' => 'int',
                'label' => 'Ecological',
                'input' => 'boolean',
                'required' => false,
                'sort_order' => 10,
                'source' => 'Magento\Eav\Model\Entity\Attribute\Source\Boolean',
                'global' => ScopedAttributeInterface::SCOPE_GLOBAL,
                'is_used_in_grid' => false,
                'is_visible_in_grid' => false,
                'is_filterable_in_grid' => true,
                'visible' => true,
                'is_html_allowed_on_front' => false,
                'visible_on_front' => true,
                'filterable' => true,
                'used_in_product_listing' => true,
                'apply_to' => 'configurable'
            ]
        ];

        foreach ($newAttribute as $attribiuteKey => $attribiuteValue) {
            $eavSetup->addAttribute(
                Product::ENTITY,
                $attribiuteKey,
                $attribiuteValue
            );
        }
    }
}
