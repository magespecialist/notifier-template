<?php
/**
 * Copyright © MageSpecialist - Skeeller srl. All rights reserved.
 * See COPYING.txt for license details.
 */

declare(strict_types=1);

namespace MSP\NotifierTemplate\Model\VariablesDecorator;

/**
 * Variable decorator interface
 * @api
 */
interface VariablesDecoratorInterface
{

    /**
     * Decorate array with variables
     * @param array $data
     * @return void
     */
    public function execute(array &$data);
}
