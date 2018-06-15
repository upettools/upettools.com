<?php

namespace Become\Wholesale\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Ddl\Table;

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
        $installer = $setup;

        $installer->startSetup();

        $table = $installer->getConnection()
            ->newTable($installer->getTable('shop_wholesale'))
            ->addColumn(
                'shop_wholesale_id',
                Table::TYPE_INTEGER,
                null,
                ['identity' => true, 'nullable' => false, 'primary' => true],
                'Wholesale ID'
            )
            ->addColumn('personal_name', Table::TYPE_TEXT, 255, ['nullable' => false], 'Personal Name')
            ->addColumn('email', Table::TYPE_TEXT, 255, ['nullable' => true, 'default' => null])
            ->addColumn('phone_number', Table::TYPE_INTEGER, 20, ['nullable' => true, 'default' => null])
            ->addColumn('additionalcategory', Table::TYPE_INTEGER, 2, ['nullable' => true, 'default' => null])
            ->addColumn('additionalname', Table::TYPE_TEXT, 255, ['nullable' => true, 'default' => null])
            ->addColumn('files_name_url', Table::TYPE_TEXT, 255, ['nullable' => true, 'default' => null])
            ->addColumn('interested_categories', Table::TYPE_TEXT, 255, ['nullable' => true, 'default' => null],'Interested categories')
            ->addColumn('sales_area', Table::TYPE_TEXT, 255, ['nullable' => true, 'default' => null],'Sales to where')
            ->addColumn('sales_amount', Table::TYPE_DECIMAL, [12, 4], [], 'Sales target amount')
			->addColumn(
                'created_at',
                Table::TYPE_TIMESTAMP,
				null,
				[
					'nullable' => false,
					'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT,
					'COMMENT' => 'Created'
				]
            )
            ->addIndex($installer->getIdxName('shop_wholesale_id', ['shop_wholesale_id']), ['shop_wholesale_id'])
            ->setComment('Shop Wholesale');

        $installer->getConnection()->createTable($table);

        $installer->endSetup();
    }

}
