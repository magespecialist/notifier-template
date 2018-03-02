<?php
/**
 * Copyright © MageSpecialist - Skeeller srl. All rights reserved.
 * See COPYING.txt for license details.
 */

declare(strict_types=1);

namespace MSP\NotifierTemplate\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use MSP\NotifierTemplate\Setup\Operation\CreateTemplateTable;

class InstallSchema implements InstallSchemaInterface
{
    /**
     * @var CreateTemplateTable
     */
    private $createTemplateTable;

    /**
     * InstallSchema constructor.
     * @param CreateTemplateTable $createTemplateTable
     */
    public function __construct(
        CreateTemplateTable $createTemplateTable
    ) {
        $this->createTemplateTable = $createTemplateTable;
    }

    /**
     * {@inheritdoc}
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();
        $this->createTemplateTable->execute($setup);
        $setup->endSetup();
    }
}
