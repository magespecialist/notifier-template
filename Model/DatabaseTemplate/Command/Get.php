<?php
/**
 * Automatically created by MageSpecialist CodeMonkey
 * https://github.com/magespecialist/m2-MSP_CodeMonkey
 */

declare(strict_types=1);

namespace MSP\NotifierTemplate\Model\DatabaseTemplate\Command;

use Magento\Framework\Exception\NoSuchEntityException;
use MSP\NotifierTemplate\Model\ResourceModel\DatabaseTemplate;
use MSP\NotifierTemplateApi\Api\Data\DatabaseTemplateInterface;
use MSP\NotifierTemplateApi\Api\Data\DatabaseTemplateInterfaceFactory;

/**
 * @inheritdoc
 */
class Get implements GetInterface
{
    /**
     * @var DatabaseTemplate
     */
    private $resource;

    /**
     * @var DatabaseTemplateInterfaceFactory
     */
    private $factory;

    /**
     * @param DatabaseTemplate $resource
     * @param DatabaseTemplateInterfaceFactory $factory
     */
    public function __construct(
        DatabaseTemplate $resource,
        DatabaseTemplateInterfaceFactory $factory
    ) {
        $this->resource = $resource;
        $this->factory = $factory;
    }

    /**
     * @inheritdoc
     */
    public function execute(int $databaseTemplateId): DatabaseTemplateInterface
    {
        /** @var DatabaseTemplateInterface $databaseTemplate */
        $databaseTemplate = $this->factory->create();
        $this->resource->load(
            $databaseTemplate,
            $databaseTemplateId,
            DatabaseTemplateInterface::ID
        );

        if (null === $databaseTemplate->getId()) {
            throw new NoSuchEntityException(__('DatabaseTemplate with id "%value" does not exist.', [
                'value' => $databaseTemplateId
            ]));
        }

        return $databaseTemplate;
    }
}
