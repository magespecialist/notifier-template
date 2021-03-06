<?php
/**
 * Automatically created by MageSpecialist CodeMonkey
 * https://github.com/magespecialist/m2-MSP_CodeMonkey
 */

declare(strict_types=1);

namespace MSP\NotifierTemplate\Model\DatabaseTemplate\Command;

use Magento\Framework\Exception\CouldNotDeleteException;

/**
 * Delete DatabaseTemplate by databaseTemplateId command (Service Provider Interface - SPI)
 *
 * Separate command interface to which Repository proxies initial Delete call, could be considered as SPI - Interfaces
 * that you should extend and implement to customize current behaviour, but NOT expected to be used (called) in the code
 * of business logic directly
 *
 * @see \MSP\NotifierTemplateApi\Api\DatabaseTemplateRepositoryInterface
 * @api
 */
interface DeleteInterface
{
    /**
     * Delete DatabaseTemplate data by given databaseTemplateId
     *
     * @param int $databaseTemplateId
     * @return void
     * @throws CouldNotDeleteException
     */
    public function execute(int $databaseTemplateId);
}
