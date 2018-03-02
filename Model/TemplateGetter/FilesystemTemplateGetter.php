<?php
/**
 * Copyright © MageSpecialist - Skeeller srl. All rights reserved.
 * See COPYING.txt for license details.
 */

declare(strict_types=1);

namespace MSP\NotifierTemplate\Model\TemplateGetter;

use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Filesystem\Io\File;
use Magento\Framework\Module\Dir\Reader;
use Magento\Framework\View\Asset\Repository;
use Magento\Framework\View\FileSystem;
use MSP\NotifierApi\Api\ChannelRepositoryInterface;
use MSP\NotifierTemplate\Model\FilesystemTemplateRepository;
use MSP\NotifierTemplate\Model\FilesystemTemplateRepositoryInterface;

class FilesystemTemplateGetter implements TemplateGetterInterface
{
    /**
     * @var ChannelRepositoryInterface
     */
    private $channelRepository;

    /**
     * @var File
     */
    private $file;

    /**
     * @var Reader
     */
    private $reader;

    /**
     * @var FilesystemTemplateRepositoryInterface
     */
    private $filesystemTemplateRepository;

    /**
     * FilesystemGetter constructor.
     * @param ChannelRepositoryInterface $channelRepository
     * @param File $file
     * @param Reader $reader
     * @param FilesystemTemplateRepositoryInterface $filesystemTemplateRepository
     * @SuppressWarnings(PHPMD.LongVariables)
     */
    public function __construct(
        ChannelRepositoryInterface $channelRepository,
        File $file,
        Reader $reader,
        FilesystemTemplateRepositoryInterface $filesystemTemplateRepository
    ) {
        $this->channelRepository = $channelRepository;
        $this->file = $file;
        $this->reader = $reader;
        $this->filesystemTemplateRepository = $filesystemTemplateRepository;
    }

    /**
     * Get an adapter template
     * @param string $adapterCode
     * @param string $templateId
     * @return string
     * @throws \Magento\Framework\Exception\LocalizedException
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getAdapterTemplate(string $adapterCode, string $templateId): string
    {
        $adapterCode = preg_replace('/[^\w\_]+/', '', $adapterCode);

        $templateFile = $this->filesystemTemplateRepository->get($templateId);

        list($module, $filePath) = Repository::extractModule(
            FileSystem::normalizePath($templateFile)
        );

        $templatePath = $this->reader->getModuleDir('', $module). '/' .
            FilesystemTemplateRepository::TEMPLATE_MODULE_DIR;

        if ($adapterCode) {
            $fullPath = $templatePath . '/' . $adapterCode . '/' . $filePath;
        } else {
            $fullPath = $templatePath . '/' . $filePath;
        }

        if (!$this->file->fileExists($fullPath, true)) {
            throw new NoSuchEntityException(__('Template %1 does not exist', $adapterCode . '/' . $filePath));
        }

        return $this->file->read($fullPath);
    }

    /**
     * @inheritdoc
     */
    public function getTemplate(string $channelCode, string $templateId): string
    {
        if ($channelCode) {
            $channel = $this->channelRepository->getByCode($channelCode);
            $adapterCode = preg_replace('/[^\w\_]+/', '', $channel->getAdapterCode());

            try {
                return $this->getAdapterTemplate($adapterCode, $templateId);
            } catch (NoSuchEntityException $e) { }
        }

        return $this->getAdapterTemplate('', $templateId);
    }

    /**
     * @inheritdoc
     */
    public function getList(): array
    {
        return $this->filesystemTemplateRepository->getList();
    }
}
