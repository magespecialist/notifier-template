<?php
/**
 * Copyright © MageSpecialist - Skeeller srl. All rights reserved.
 * See COPYING.txt for license details.
 */

declare(strict_types=1);

namespace MSP\NotifierTemplate\Model;

use Magento\Framework\Filesystem\Io\File;
use Magento\Framework\Module\Dir\Reader;
use MSP\NotifierTemplate\Model\TemplateGetter\TemplateGetterInterface;
use MSP\NotifierTemplate\Model\VariablesDecorator\VariablesDecoratorInterface;
use Twig_Environment;
use Twig_Loader_Array;

class GetMessageText implements GetMessageTextInterface
{
    /**
     * @var Reader
     */
    private $reader;

    /**
     * @var File
     */
    private $file;

    /**
     * @var VariablesDecoratorInterface
     */
    private $variablesDecorator;

    /**
     * @var TemplateGetterInterface
     */
    private $templateGetterPool;

    /**
     * GetMessageText constructor.
     * @param Reader $reader
     * @param File $file
     * @param TemplateGetterInterface $templateGetterPool
     * @param VariablesDecoratorInterface $variablesDecorator
     * @SuppressWarnings(PHPMD.LongVariables)
     */
    public function __construct(
        Reader $reader,
        File $file,
        TemplateGetterInterface $templateGetterPool,
        VariablesDecoratorInterface $variablesDecorator
    ) {
        $this->reader = $reader;
        $this->file = $file;
        $this->variablesDecorator = $variablesDecorator;
        $this->templateGetterPool = $templateGetterPool;
    }

    /**
     * Get a template formatted message
     * @param string $channelCode
     * @param string $templateId
     * @param array $params
     * @return string
     */
    public function execute(string $channelCode, string $templateId, array $params = []): string
    {
        $template = $this->templateGetterPool->getTemplate($channelCode, $templateId);
        if (!$template) {
            return '';
        }

        // @codingStandardsIgnoreStart
        $loader = new Twig_Loader_Array([
            $templateId => $template,
        ]);
        $twig = new Twig_Environment($loader);
        // @codingStandardsIgnoreEnd

        $this->variablesDecorator->execute($params);

        try {
            return $twig->render($templateId, $params);
        } catch (\Exception $e) {
            return '';
        }
    }
}
