<?php
/**
 * Automatically created by MageSpecialist CodeMonkey
 * https://github.com/magespecialist/m2-MSP_CodeMonkey
 */

declare(strict_types=1);

namespace MSP\NotifierTemplate\Model;

use MSP\NotifierTemplateApi\Api\Data\DatabaseTemplateInterface;

/**
 * Extension attribute loader for DatabaseTemplate
 *
 * @api
 */
interface DatabaseTemplateExtensionLoaderInterface
{
    /**
     * Load extension attributes
     * @param DatabaseTemplateInterface $databaseTemplate
     */
    public function execute(DatabaseTemplateInterface $databaseTemplate);
}
