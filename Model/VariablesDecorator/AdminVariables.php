<?php
/**
 * Copyright © MageSpecialist - Skeeller srl. All rights reserved.
 * See COPYING.txt for license details.
 */

declare(strict_types=1);

namespace MSP\NotifierTemplate\Model\VariablesDecorator;

use Magento\Backend\Model\Auth\Session;

class AdminVariables implements VariablesDecoratorInterface
{
    const VARIABLE_ADMIN_USER = '_adminUser';

    /**
     * @var Session
     */
    private $session;

    /**
     * CoreDecorator constructor.
     * @param Session $session
     */
    public function __construct(
        Session $session
    ) {
        $this->session = $session;
    }

    /**
     * @inheritdoc
     */
    public function execute(array &$data)
    {
        $data[self::VARIABLE_ADMIN_USER] = $this->session->getUser();
    }
}
