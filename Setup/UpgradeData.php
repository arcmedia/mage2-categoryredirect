<?php
/**
 * Created by PhpStorm.
 * User: felix.elsener
 * Date: 21.02.2018
 * Time: 09:18
 */

namespace Arcmedia\CategoryRedirect\Setup;

use Magento\Catalog\Model\Category;
use Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\UpgradeDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class UpgradeData implements UpgradeDataInterface
{
    /**
     * EAV setup factory
     *
     * @var EavSetupFactory
     */
    private $_eavSetupFactory;

    /**
     * Constructor
     *
     * @param EavSetupFactory $eavSetupFactory
     */
    public function __construct(
        EavSetupFactory $eavSetupFactory
    ) {
        $this->eavSetupFactory = $eavSetupFactory;
    }

    public function upgrade(
        ModuleDataSetupInterface $setup,
        ModuleContextInterface $context
    ) {
        $setup->startSetup();

        //Upgrade to 0.1.1
        if (version_compare($context->getVersion(), '0.1.1') < 0) {
            /** @var EavSetup $eavSetup */
            $eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);

            /**
             * Add attributes to the eav/attribute
             */
            $eavSetup->removeAttribute(Category::ENTITY, 'redirect_url');
            $eavSetup->addAttribute(
                Category::ENTITY,
                'redirect_url',
                [
                    'type' => 'varchar',
                    'group' => 'General',
                    'label' => 'Redirect URL',
                    'input' => 'text',
                    'required' => false,
                    'sort_order' => 2,
                    'global' => ScopedAttributeInterface::SCOPE_STORE,
                    'is_used_in_grid' => true,
                    'is_visible_in_grid' => false,
                    'is_filterable_in_grid' => true,
                    'visible_on_front' => true,
                ]
            );
        }

        //Upgrade to 0.1.2
        if (version_compare($context->getVersion(), '0.1.2') < 0) {
            /** @var EavSetup $eavSetup */
            $eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);

            /**
             * Add attributes to the eav/attribute
             */
            $eavSetup->removeAttribute(Category::ENTITY, 'use_redirect_url');
            $eavSetup->addAttribute(
                Category::ENTITY,
                'use_redirect_url',
                [
                    'type' => 'int',
                    'group' => 'General',
                    'label' => 'Use Redirect URL',
                    'input' => 'select',
                    'required' => false,
                    'source' => 'Magento\Eav\Model\Entity\Attribute\Source\Boolean',
                    'default' => 0,
                    'sort_order' => 1,
                    'global' => ScopedAttributeInterface::SCOPE_STORE,
                    'is_used_in_grid' => true,
                    'is_visible_in_grid' => false,
                    'is_filterable_in_grid' => true,
                    'visible_on_front' => true,
                ]
            );
        }

        $setup->endSetup();
    }
}