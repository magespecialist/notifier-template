<?php
/**
 * Automatically created by MageSpecialist CodeMonkey
 * https://github.com/magespecialist/m2-MSP_CodeMonkey
 */

declare(strict_types=1);

namespace MSP\NotifierTemplate\Model;

use MSP\NotifierTemplateApi\Api\Data\DatabaseTemplateExtensionFactory;
use MSP\NotifierTemplateApi\Api\Data\DatabaseTemplateInterface;

class DatabaseTemplateExtensionLoader implements DatabaseTemplateExtensionLoaderInterface
{
    /**
     * @var DatabaseTemplateExtensionFactory
     */
    private $extensionFactory;

    /**
     * Extension loader constructor.
     * @param DatabaseTemplateExtensionFactory $extensionFactory
     * @SuppressWarnings(PHPMD.LongVariables)
     */
    public function __construct(
        DatabaseTemplateExtensionFactory $extensionFactory
    ) {
        $this->extensionFactory = $extensionFactory;
    }

    /**
     * @inheritdoc
     */
    public function execute(DatabaseTemplateInterface $databaseTemplate)
    {
        if ($databaseTemplate->getExtensionAttributes() === null) {
            $extension = $this->extensionFactory->create();
            $databaseTemplate->setExtensionAttributes($extension);
        }
    }
}
