<?php
/**
 * Copyright © MageSpecialist - Skeeller srl. All rights reserved.
 * See COPYING.txt for license details.
 */

declare(strict_types=1);

namespace MSP\NotifierTemplate\Model\DatabaseTemplate\Validator;

use MSP\NotifierTemplateApi\Api\Data\DatabaseTemplateInterface;

class CodeValidator implements DatabaseTemplateValidatorInterface
{
    /**
     * Execute validation. Return true on success or trigger an exception on failure
     * @param DatabaseTemplateInterface $template
     * @return bool
     * @throws \InvalidArgumentException
     */
    public function execute(DatabaseTemplateInterface $template): bool
    {
        if (!preg_match('/^(\w+:)?[\w_]+$/', $template->getCode())) {
            throw new \InvalidArgumentException(
                '' . __('Invalid template identifier: Only alphanumeric chars + columns')
            );
        }

        if (!trim($template->getCode())) {
            throw new \InvalidArgumentException('' . __('Template identifier is required'));
        }

        return true;
    }
}
