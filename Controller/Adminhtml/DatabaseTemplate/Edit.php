<?php
/**
 * Copyright © MageSpecialist - Skeeller srl. All rights reserved.
 * See COPYING.txt for license details.
 */

declare(strict_types=1);

namespace MSP\NotifierTemplate\Controller\Adminhtml\DatabaseTemplate;

use Magento\Backend\App\Action;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use MSP\NotifierTemplateApi\Api\DatabaseTemplateRepositoryInterface;
use MSP\NotifierTemplateApi\Api\Data\DatabaseTemplateInterface;

class Edit extends Action
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
     * Edit constructor.
     * @param Action\Context $context
     * @param DatabaseTemplateRepositoryInterface $templateRepository
     */
    public function __construct(
        Action\Context $context,
        DatabaseTemplateRepositoryInterface $templateRepository
    ) {
        parent::__construct($context);
        $this->templateRepository = $templateRepository;
    }

    /**
     * @inheritdoc
     */
    public function execute(): ResultInterface
    {
        $templateId = (int) $this->getRequest()->getParam(DatabaseTemplateInterface::ID);
        try {
            $template = $this->templateRepository->get($templateId);
            $result = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
            $result
                ->setActiveMenu('MSP_NotifierTemplate::template')
                ->addBreadcrumb(__('Edit Template'), __('Edit Template'));

            $result->getConfig()
                ->getTitle()
                ->prepend(__('Edit Template: %name', ['name' => $template->getName()]));
        } catch (NoSuchEntityException $e) {
            $result = $this->resultRedirectFactory->create();
            $this->messageManager->addErrorMessage(
                __('Cannot load template %1: %2', $templateId, $e->getMessage())
            );
            $result->setPath('*/*');
        }

        return $result;
    }
}
