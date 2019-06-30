<?php

namespace Nans\RequestPrice\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Ddl\Table;

class InstallSchema implements InstallSchemaInterface
{
    /**
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     * @throws \Zend_Db_Exception
     */
    public function install(
        SchemaSetupInterface $setup,
        ModuleContextInterface $context
    )
    {
        $setup->startSetup();
        $this->_createRequestTable($setup);
        $setup->endSetup();
    }

    /**
     * @param SchemaSetupInterface $setup
     * @throws \Zend_Db_Exception
     */
    private function _createRequestTable(SchemaSetupInterface $setup)
    {
        $tableName = $setup->getTable('request_price');

        if ($setup->tableExists($tableName)) {
            return;
        }

        $table = $setup->getConnection()->newTable($tableName);
        $table->addColumn(
            'request_id', Table::TYPE_INTEGER, null,
            [
                'identity' => true,
                'nullable' => false,
                'primary' => true,
                'unsigned' => true
            ], 'ID'
        );
        $table->addColumn('name', Table::TYPE_TEXT, 255, ['nullable' => false], 'Name');
        $table->addColumn('email', Table::TYPE_TEXT, 255, ['nullable' => false], 'Email');
        $table->addColumn('sku', Table::TYPE_TEXT, 255, ['nullable' => false], 'SKU');
        $table->addColumn('comment', Table::TYPE_TEXT, 255, ['nullable' => true, 'default' => ''], 'Comment');
        $table->addColumn(
            'status',
            Table::TYPE_BOOLEAN,
            null,
            ['nullable' => false, 'default' => 0],
            'Status'
        );
        $table->addColumn(
            'created_at',
            Table::TYPE_TIMESTAMP,
            null,
            ['nullable' => false, 'default' => Table::TIMESTAMP_INIT],
            'Created at'
        );

        $this->_addIndex($table, $setup, ['sku']);
        $this->_addIndex($table, $setup, ['name']);
        $this->_addIndex($table, $setup, ['email']);
        $table->setComment('Request Price');
        $setup->getConnection()->createTable($table);
    }

    /**
     * @param Table $table
     * @param SchemaSetupInterface $setup
     * @param array $fields
     * @throws \Zend_Db_Exception
     */
    private function _addIndex(Table &$table, SchemaSetupInterface $setup, array $fields)
    {
        $table->addIndex($setup->getIdxName($table->getName(), $fields), $fields);
    }
}