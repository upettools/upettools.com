<?php

namespace Become\Supplier\Setup;

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
            ->newTable($installer->getTable('shop_supplier'))
            ->addColumn(
                'shop_supplier_id',
                Table::TYPE_INTEGER,
                null,
                ['identity' => true, 'nullable' => false, 'primary' => true],
                'Supplier ID'
            )
            ->addColumn('personal_name', Table::TYPE_TEXT, 255, ['nullable' => false], 'Personal Name')
            ->addColumn('email', Table::TYPE_TEXT, 255, ['nullable' => true, 'default' => null])
            ->addColumn('telephone', Table::TYPE_INTEGER, 20, ['nullable' => true, 'default' => null])
            ->addColumn('company', Table::TYPE_TEXT, 255, ['nullable' => true, 'default' => null])
            ->addColumn('address', Table::TYPE_TEXT, 255, ['nullable' => true, 'default' => null])
            ->addColumn('categories', Table::TYPE_TEXT, 255, ['nullable' => true, 'default' => null],'Interested categories')
            ->addColumn('files_name_url', Table::TYPE_TEXT, 255, ['nullable' => true, 'default' => null],'Sales to where')
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
            ->addIndex($installer->getIdxName('shop_supplier_id', ['shop_supplier_id']), ['shop_supplier_id'])
            ->setComment('Shop Supplier');

        $installer->getConnection()->createTable($table);

        $installer->endSetup();
    }

}
