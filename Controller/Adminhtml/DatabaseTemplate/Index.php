<?php
/**
 * Copyright © MageSpecialist - Skeeller srl. All rights reserved.
 * See COPYING.txt for license details.
 */

declare(strict_types=1);

namespace MSP\NotifierTemplate\Controller\Adminhtml\DatabaseTemplate;

use Magento\Backend\App\Action;
use Magento\Backend\Model\View\Result\Page;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;

/**
 * Index Controller
 */
class Index extends Action
{
    /**
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'MSP_NotifierTemplate::template';

    /**
     * @inheritdoc
     */
    public function execute(): ResultInterface
    {
        /** @var Page $resultPage */
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $resultPage
            ->setActiveMenu('MSP_NotifierTemplate::template')
            ->addBreadcrumb(__('Templates'), __('List'));
        $resultPage->getConfig()->getTitle()->prepend(__('Manage Templates'));

        return $resultPage;
    }
}
