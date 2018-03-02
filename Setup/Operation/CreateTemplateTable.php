<?php
/**
 * Copyright © MageSpecialist - Skeeller srl. All rights reserved.
 * See COPYING.txt for license details.
 */

declare(strict_types=1);

namespace MSP\NotifierTemplate\Setup\Operation;

use Magento\Framework\DB\Adapter\AdapterInterface;
use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\SchemaSetupInterface;

class CreateTemplateTable
{
    const TABLE_NAME_TEMPLATE = 'msp_notifier_template';

    /**
     * @param SchemaSetupInterface $setup
     * @return void
     * @throws \Zend_Db_Exception
     */
    public function execute(SchemaSetupInterface $setup)
    {
        $table = $setup->getConnection()->newTable(
            $setup->getTable(self::TABLE_NAME_TEMPLATE)
        )->setComment(
            'MSP Notifier Template Table'
        );

        $table = $this->addFields($table);
        $table = $this->addIndexes($setup, $table);

        $setup->getConnection()->createTable($table);
    }

    /**
     * Add fields
     * @param Table $table
     * @return Table
     * @throws \Zend_Db_Exception
     */
    private function addFields(Table $table): Table
    {
        $table
            ->addColumn(
                'template_id',
                Table::TYPE_INTEGER,
                null,
                [
                    'identity' => true,
                    'unsigned' => true,
                    'nullable' => false,
                    'primary' => true,
                ],
                'Queue ID'
            )
            ->addColumn(
                'code',
                Table::TYPE_TEXT,
                null,
                [
                    'nullable' => true,
                ],
                'Template Code'
            )
            ->addColumn(
                'adapter_code',
                Table::TYPE_TEXT,
                null,
                [
                    'nullable' => true,
                ],
                'Adapter code specific'
            )
            ->addColumn(
                'name',
                Table::TYPE_TEXT,
                null,
                [
                    'nullable' => false,
                ],
                'Template name'
            )
            ->addColumn(
                'template',
                Table::TYPE_TEXT,
                null,
                [
                    'nullable' => false,
                ],
                'Template'
            );

        return $table;
    }

    /**
     * Add indexes
     * @param SchemaSetupInterface $setup
     * @param Table $table
     * @return Table
     * @throws \Zend_Db_Exception
     */
    private function addIndexes(SchemaSetupInterface $setup, Table $table): Table
    {
        $table->addIndex(
            $setup->getIdxName(
                self::TABLE_NAME_TEMPLATE,
                ['code', 'adapter_code'],
                AdapterInterface::INDEX_TYPE_UNIQUE
            ),
            [
                ['name' => 'code', 'size' => 128],
                ['name' => 'adapter_code', 'size' => 128]
            ],
            ['type' => AdapterInterface::INDEX_TYPE_UNIQUE]
        );

        $table->addIndex(
            $setup->getIdxName(
                self::TABLE_NAME_TEMPLATE,
                ['code'],
                AdapterInterface::INDEX_TYPE_INDEX
            ),
            [
                ['name' => 'code', 'size' => 128],
            ],
            ['type' => AdapterInterface::INDEX_TYPE_INDEX]
        );

        return $table;
    }
}
