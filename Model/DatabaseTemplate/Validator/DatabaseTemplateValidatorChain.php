<?php
/**
 * Copyright © MageSpecialist - Skeeller srl. All rights reserved.
 * See COPYING.txt for license details.
 */

declare(strict_types=1);

namespace MSP\NotifierTemplate\Model\DatabaseTemplate\Validator;

use MSP\NotifierTemplateApi\Api\Data\DatabaseTemplateInterface;

class DatabaseTemplateValidatorChain implements DatabaseTemplateValidatorInterface
{
    /**
     * @var DatabaseTemplateValidatorInterface[]
     */
    private $validators;

    /**
     * DatabaseTemplateValidatorChain constructor.
     * @param array $validators
     */
    public function __construct(
        array $validators = []
    ) {
        $this->validators = $validators;

        foreach ($this->validators as $k => $validator) {
            if (!($validator instanceof DatabaseTemplateValidatorInterface)) {
                throw new \InvalidArgumentException(
                    'Validator %1 must implement DatabaseTemplateValidatorInterface',
                    $k
                );
            }
        }
    }

    /**
     * Execute validation. Return true on success or trigger an exception on failure
     * @param DatabaseTemplateInterface $template
     * @return bool
     * @throws \InvalidArgumentException
     */
    public function execute(DatabaseTemplateInterface $template): bool
    {
        foreach ($this->validators as $validator) {
            $validator->execute($template);
        }

        return true;
    }
}
