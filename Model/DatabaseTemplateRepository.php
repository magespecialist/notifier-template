<?php
/**
 * Automatically created by MageSpecialist CodeMonkey
 * https://github.com/magespecialist/m2-MSP_CodeMonkey
 */

declare(strict_types=1);

namespace MSP\NotifierTemplate\Model;

use Magento\Framework\Api\SearchCriteriaInterface;
use MSP\NotifierTemplate\Model\DatabaseTemplate\Command\DeleteInterface;
use MSP\NotifierTemplate\Model\DatabaseTemplate\Command\GetByAdapterCodeInterface;
use MSP\NotifierTemplate\Model\DatabaseTemplate\Command\GetByCodeInterface;
use MSP\NotifierTemplate\Model\DatabaseTemplate\Command\GetInterface;
use MSP\NotifierTemplate\Model\DatabaseTemplate\Command\GetListInterface;
use MSP\NotifierTemplate\Model\DatabaseTemplate\Command\SaveInterface;
use MSP\NotifierTemplateApi\Api\Data\DatabaseTemplateInterface;
use MSP\NotifierTemplateApi\Api\DatabaseTemplateRepositoryInterface;
use MSP\NotifierTemplateApi\Api\DatabaseTemplateSearchResultsInterface;

/**
 * @SuppressWarnings(PHPMD.ShortVariable)
 * @SuppressWarnings(PHPMD.LongVariable)
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class DatabaseTemplateRepository implements DatabaseTemplateRepositoryInterface
{
    /**
     * @var SaveInterface
     */
    private $commandSave;

    /**
     * @var GetInterface
     */
    private $commandGet;

    /**
     * @var GetByCodeInterface
     */
    private $commandGetByCode;

    /**
     * @var GetByAdapterCodeInterface
     */
    private $commandGetByAdapterCode;

    /**
     * @var DeleteInterface
     */
    private $commandDeleteById;

    /**
     * @var GetListInterface
     */
    private $commandGetList;

    /**
     * @param SaveInterface $commandSave
     * @param GetInterface $commandGet
     * @param GetByCodeInterface $commandGetByCode
     * @param GetByAdapterCodeInterface $commandGetByAdapterCode
     * @param DeleteInterface $commandDeleteById
     * @param GetListInterface $commandGetList
     */
    public function __construct(
        SaveInterface $commandSave,
        GetInterface $commandGet,
        GetByCodeInterface $commandGetByCode,
        GetByAdapterCodeInterface $commandGetByAdapterCode,
        DeleteInterface $commandDeleteById,
        GetListInterface $commandGetList
    ) {
        $this->commandSave = $commandSave;
        $this->commandGet = $commandGet;
        $this->commandGetByCode = $commandGetByCode;
        $this->commandGetByAdapterCode = $commandGetByAdapterCode;
        $this->commandDeleteById = $commandDeleteById;
        $this->commandGetList = $commandGetList;
    }

    /**
     * @inheritdoc
     */
    public function save(DatabaseTemplateInterface $databaseTemplate): int
    {
        return $this->commandSave->execute($databaseTemplate);
    }

    /**
     * @inheritdoc
     */
    public function get(int $databaseTemplateId): DatabaseTemplateInterface
    {
        return $this->commandGet->execute($databaseTemplateId);
    }

    /**
     * @inheritdoc
     */
    public function getByCode(string $code): DatabaseTemplateInterface
    {
        return $this->commandGetByCode->execute($code);
    }

    /**
     * @inheritdoc
     */
    public function getByAdapterCode(string $adapterCode): DatabaseTemplateInterface
    {
        return $this->commandGetByAdapterCode->execute($adapterCode);
    }

    /**
     * @inheritdoc
     */
    public function deleteById(int $databaseTemplateId)
    {
        $this->commandDeleteById->execute($databaseTemplateId);
    }

    /**
     * @inheritdoc
     */
    public function getList(
        SearchCriteriaInterface $searchCriteria = null
    ): DatabaseTemplateSearchResultsInterface {
        return $this->commandGetList->execute($searchCriteria);
    }
}
