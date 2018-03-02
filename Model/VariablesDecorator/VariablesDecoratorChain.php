<?php
/**
 * Copyright © MageSpecialist - Skeeller srl. All rights reserved.
 * See COPYING.txt for license details.
 */

declare(strict_types=1);

namespace MSP\NotifierTemplate\Model\VariablesDecorator;

class VariablesDecoratorChain implements VariablesDecoratorInterface
{
    /**
     * @var VariablesDecoratorInterface[]
     */
    private $decorators;

    /**
     * VariablesDecoratorPool constructor.
     * @param array $decorators
     * @SuppressWarnings(PHPMD.LongVariables)
     */
    public function __construct(
        array $decorators
    ) {
        $this->decorators = $decorators;
    }

    /**
     * @inheritdoc
     */
    public function execute(array &$data)
    {
        foreach ($this->decorators as $decorator) {
            $decorator->execute($data);
        }
    }
}
