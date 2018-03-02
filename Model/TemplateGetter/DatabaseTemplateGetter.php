<?php
/**
 * Copyright © MageSpecialist - Skeeller srl. All rights reserved.
 * See COPYING.txt for license details.
 */

declare(strict_types=1);

namespace MSP\NotifierTemplate\Model\TemplateGetter;

use Magento\Framework\Exception\NoSuchEntityException;
use MSP\NotifierApi\Api\ChannelRepositoryInterface;
use MSP\NotifierTemplate\Model\ResourceModel\DatabaseTemplate\CollectionFactory;
use MSP\NotifierTemplateApi\Api\Data\DatabaseTemplateInterface;

class DatabaseTemplateGetter implements TemplateGetterInterface
{
    /**
     * @var CollectionFactory
     */
    private $collectionFactory;

    /**
     * @var ChannelRepositoryInterface
     */
    private $channelRepository;

    public function __construct(
        CollectionFactory $collectionFactory,
        ChannelRepositoryInterface $channelRepository
    ) {
        $this->collectionFactory = $collectionFactory;
        $this->channelRepository = $channelRepository;
    }

    /**
     * @inheritdoc
     */
    public function getTemplate(string $channelCode, string $templateId): string
    {
        try {
            $channel = $this->channelRepository->getByCode($channelCode);
            $adapterCode = $channel->getAdapterCode();
        } catch (NoSuchEntityException $e) {
            $adapterCode = '';
        }

        $collection = $this->collectionFactory->create();
        $collection->filterAdapterCandidates($adapterCode, $templateId);

        if ($collection->getSize()) {
            return (string) $collection->getFirstItem()->getTemplate();
        }

        return '';
    }

    /**
     * @inheritdoc
     */
    public function getList(): array
    {
        $res = [];

        $collection = $this->collectionFactory->create();
        foreach ($collection as $template) {
            /** @var DatabaseTemplateInterface $template */
            $res[$template->getCode()] = [
                'label' => $template->getName(),
            ];
        }

        return $res;
    }
}
