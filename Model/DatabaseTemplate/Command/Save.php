<?php
/**
 * Automatically created by MageSpecialist CodeMonkey
 * https://github.com/magespecialist/m2-MSP_CodeMonkey
 */

declare(strict_types=1);

namespace MSP\NotifierTemplate\Model\DatabaseTemplate\Command;

use Magento\Framework\Exception\CouldNotSaveException;
use MSP\NotifierTemplate\Model\DatabaseTemplate\Validator\DatabaseTemplateValidatorInterface;
use MSP\NotifierTemplate\Model\ResourceModel\DatabaseTemplate;
use MSP\NotifierTemplateApi\Api\Data\DatabaseTemplateInterface;
use Psr\Log\LoggerInterface;

/**
 * @inheritdoc
 */
class Save implements SaveInterface
{
    /**
     * @var DatabaseTemplate
     */
    private $resource;

    /**
     * @var LoggerInterface
     */
    private $logger;
    /**
     * @var DatabaseTemplateValidatorInterface
     */
    private $databaseTemplateValidator;

    /**
     * @param DatabaseTemplate $resource
     * @param DatabaseTemplateValidatorInterface $databaseTemplateValidator
     * @SuppressWarnings(PHPMD.LongVariables)
     */
    public function __construct(
        DatabaseTemplate $resource,
        DatabaseTemplateValidatorInterface $databaseTemplateValidator,
        LoggerInterface $logger
    ) {
        $this->resource = $resource;
        $this->logger = $logger;
        $this->databaseTemplateValidator = $databaseTemplateValidator;
    }

    /**
     * @inheritdoc
     */
    public function execute(DatabaseTemplateInterface $databaseTemplate): int
    {
        $this->databaseTemplateValidator->execute($databaseTemplate);

        try {
            $this->resource->save($databaseTemplate);
            return (int) $databaseTemplate->getId();
        } catch (\Exception $e) {
            $this->logger->error($e->getMessage());
            throw new CouldNotSaveException(__('Could not save DatabaseTemplate'), $e);
        }
    }
}
