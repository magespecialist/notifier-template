<?php
/**
 * Copyright © MageSpecialist - Skeeller srl. All rights reserved.
 * See COPYING.txt for license details.
 */

declare(strict_types=1);

namespace MSP\NotifierTemplate\Model\DatabaseTemplate\Validator;

use Magento\Framework\Exception\NoSuchEntityException;
use MSP\NotifierApi\Api\AdapterRepositoryInterface;
use MSP\NotifierTemplateApi\Api\Data\DatabaseTemplateInterface;

class AdapterValidator implements DatabaseTemplateValidatorInterface
{
    /**
     * @var AdapterRepositoryInterface
     */
    private $adapterRepository;

    /**
     * AdapterValidator constructor.
     * @param AdapterRepositoryInterface $adapterRepository
     */
    public function __construct(
        AdapterRepositoryInterface $adapterRepository
    ) {
        $this->adapterRepository = $adapterRepository;
    }

    /**
     * Execute validation. Return true on success or trigger an exception on failure
     * @param DatabaseTemplateInterface $template
     * @return bool
     * @throws \InvalidArgumentException
     */
    public function execute(DatabaseTemplateInterface $template): bool
    {
        if (!trim($template->getAdapterCode())) {
            return true;
        }

        try {
            $this->adapterRepository->getAdapterByCode($template->getAdapterCode());
        } catch (NoSuchEntityException $e) {
            throw new \InvalidArgumentException('' . __('Invalid adapter code'));
        }

        return true;
    }
}
