<?php
/**
 * Copyright © MageSpecialist - Skeeller srl. All rights reserved.
 * See COPYING.txt for license details.
 */

declare(strict_types=1);

namespace MSP\NotifierTemplate\Controller\Adminhtml\DatabaseTemplate;

use Magento\Backend\App\Action;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Controller\ResultInterface;
use MSP\NotifierApi\Api\ChannelRepositoryInterface;
use MSP\NotifierTemplate\Model\DatabaseTemplateFactory;
use MSP\Notifier\Model\SerializerInterface;
use MSP\NotifierTemplateApi\Api\DatabaseTemplateRepositoryInterface;
use MSP\NotifierTemplateApi\Api\Data\DatabaseTemplateInterface;

class Save extends Action
{
    /**
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'MSP_NotifierTemplate::template';

    /**
     * @var DatabaseTemplateRepositoryInterface
     */
    private $templateRepository;

    /**
     * @var DatabaseTemplateFactory
     */
    private $templateFactory;

    /**
     * @var DataObjectHelper
     */
    private $dataObjectHelper;

    /**
     * @var SerializerInterface
     */
    private $serializer;

    /**
     * @var ChannelRepositoryInterface
     */
    private $channelRepository;

    /**
     * Save constructor.
     * @param Action\Context $context
     * @param DatabaseTemplateRepositoryInterface $templateRepository
     * @param ChannelRepositoryInterface $channelRepository
     * @param SerializerInterface $serializer
     * @param DatabaseTemplateFactory $templateFactory
     * @param DataObjectHelper $dataObjectHelper
     * @SuppressWarnings(PHPMD.LongVariable)
     */
    public function __construct(
        Action\Context $context,
        DatabaseTemplateRepositoryInterface $templateRepository,
        ChannelRepositoryInterface $channelRepository,
        SerializerInterface $serializer,
        DatabaseTemplateFactory $templateFactory,
        DataObjectHelper $dataObjectHelper
    ) {
        parent::__construct($context);
        $this->templateRepository = $templateRepository;
        $this->templateFactory = $templateFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->serializer = $serializer;
        $this->channelRepository = $channelRepository;
    }

    /**
     * @inheritdoc
     */
    public function execute(): ResultInterface
    {
        $templateId = (int) $this->getRequest()->getParam(DatabaseTemplateInterface::ID);

        $request = $this->getRequest();
        $requestData = $request->getParams();

        if (!$request->isPost() || empty($requestData['general'])) {
            $this->messageManager->addErrorMessage(__('Wrong request.'));
            return $this->redirectAfterFailure($templateId);
        }

        $templateId = (int) $requestData['general'][DatabaseTemplateInterface::ID];
        try {
            $template = $this->save($templateId, $requestData['general']);
            $this->messageManager->addSuccessMessage(__('Template "%1" saved.', $template->getName()));
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage(__('Could not save template: %1', $e->getMessage()));
            return $this->redirectAfterFailure($templateId);
        }

        return $this->redirectAfterSave();
    }

    /**
     * Save template
     * @param int $templateId
     * @param array $data
     * @return DatabaseTemplateInterface
     */
    private function save(int $templateId, array $data): DatabaseTemplateInterface
    {
        if ($templateId) {
            $template = $this->templateRepository->get($templateId);
        } else {
            $template = $this->templateFactory->create();
        }

        $this->dataObjectHelper->populateWithArray(
            $template,
            $data,
            DatabaseTemplateInterface::class
        );

        $this->templateRepository->save($template);

        return $template;
    }

    /**
     * Return a redirect result
     * @param int $templateId
     * @return ResultInterface
     */
    private function redirectAfterFailure(int $templateId): ResultInterface
    {
        $result = $this->resultRedirectFactory->create();

        if (null === $templateId) {
            $result->setPath('*/*/new');
        } else {
            $result->setPath('*/*/edit', [DatabaseTemplateInterface::ID => $templateId]);
        }

        return $result;
    }

    /**
     * Return a redirect result after a successful save
     * @return ResultInterface
     */
    private function redirectAfterSave(): ResultInterface
    {
        $result = $this->resultRedirectFactory->create();
        $result->setPath('*/*/index');

        return $result;
    }
}
