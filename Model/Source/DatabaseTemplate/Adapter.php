<?php
/**
 * Copyright © MageSpecialist - Skeeller srl. All rights reserved.
 * See COPYING.txt for license details.
 */

declare(strict_types=1);

namespace MSP\NotifierTemplate\Model\Source\DatabaseTemplate;

use Magento\Framework\Option\ArrayInterface;
use MSP\NotifierApi\Api\AdapterRepositoryInterface;
use MSP\NotifierApi\Api\ChannelRepositoryInterface;

class Adapter implements ArrayInterface
{
    /**
     * @var AdapterRepositoryInterface
     */
    private $adapterRepository;

    public function __construct(
        AdapterRepositoryInterface $adapterRepository
    ) {
        $this->adapterRepository = $adapterRepository;
    }

    /**
     * @inheritdoc
     */
    public function toOptionArray()
    {
        $res = [[
            'value' => null,
            'label' => '' . __('- Generic -'),
        ]];
        $adapters = $this->adapterRepository->getAdapters();

        foreach ($adapters as $adapter) {
            $res[] = [
                'value' => $adapter->getCode(),
                'label' => $adapter->getDescription(),
            ];
        }

        return $res;
    }
}
