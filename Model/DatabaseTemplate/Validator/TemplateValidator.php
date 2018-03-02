<?php
/**
 * Copyright © MageSpecialist - Skeeller srl. All rights reserved.
 * See COPYING.txt for license details.
 */

declare(strict_types=1);

namespace MSP\NotifierTemplate\Model\DatabaseTemplate\Validator;

use MSP\NotifierTemplateApi\Api\Data\DatabaseTemplateInterface;
use Twig_Environment;
use Twig_Loader_Array;

class TemplateValidator implements DatabaseTemplateValidatorInterface
{
    /**
     * Execute validation. Return true on success or trigger an exception on failure
     * @param DatabaseTemplateInterface $template
     * @return bool
     * @throws \InvalidArgumentException
     */
    public function execute(DatabaseTemplateInterface $template): bool
    {
        if (!trim($template->getTemplate())) {
            throw new \InvalidArgumentException('' . __('Template is required'));
        }

        // @codingStandardsIgnoreStart
        $loader = new Twig_Loader_Array([
            $template->getCode() => $template->getTemplate(),
        ]);
        $twig = new Twig_Environment($loader);
        // @codingStandardsIgnoreEnd

        try {
            $twig->render($template->getCode());
        } catch (\Exception $e) {
            throw new \InvalidArgumentException('' . __('Template format error: %1', $e->getMessage()));
        }

        return true;
    }
}
