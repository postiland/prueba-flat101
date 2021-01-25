<?php
namespace Flat101\CollectionPoint\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Ddl\Table;

class InstallSchema implements InstallSchemaInterface
{
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;

        $installer->startSetup();

        $table = $installer->getConnection()->newTable(
            $installer->getTable('flat101_collection_points')
        )->addColumn(
            'id',
            Table::TYPE_INTEGER,
            null,
            ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
            'Id'
        )->addColumn(
            'name',
            Table::TYPE_TEXT,
            255,
            ['nullable' => false],
            'Name'
        )->addColumn(
            'address',
            Table::TYPE_TEXT,
            null,
            ['nullable' => false],
            'Address'
        )->addColumn(
            'locality',
            Table::TYPE_TEXT,
            null,
            ['nullable' => false],
            'Locality'
        )->addColumn(
            'latitude',
            Table::TYPE_TEXT,
            null,
            ['nullable' => false],
            'Latitude'
        )->addColumn(
            'longitude',
            Table::TYPE_TEXT,
            null,
            ['nullable' => false],
            'Longitude'
        )->addColumn(
            'shipping_method',
            Table::TYPE_TEXT,
            null,
            ['nullable' => false],
            'Shipping Method'
        )->setComment(
            'Collection Points'
        );

        $installer->getConnection()->createTable($table);

        $installer->endSetup();

    }
}
