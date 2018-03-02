<?php
/**
 * Copyright © MageSpecialist - Skeeller srl. All rights reserved.
 * See COPYING.txt for license details.
 */

declare(strict_types=1);

namespace MSP\NotifierTemplate\Model\DatabaseTemplate\Validator;

use MSP\NotifierTemplateApi\Api\Data\DatabaseTemplateInterface;

/**
 * Interface DatabaseTemplateValidatorInterface
 *
 * @api
 */
interface DatabaseTemplateValidatorInterface
{
    /**
     * Execute validation. Return true on success or trigger an exception on failure
     * @param DatabaseTemplateInterface $template
     * @return bool
     * @throws \InvalidArgumentException
     */
    public function execute(DatabaseTemplateInterface $template): bool;
}
