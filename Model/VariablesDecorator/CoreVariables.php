<?php
/**
 * Copyright © MageSpecialist - Skeeller srl. All rights reserved.
 * See COPYING.txt for license details.
 */

declare(strict_types=1);

namespace MSP\NotifierTemplate\Model\VariablesDecorator;

use Magento\Framework\App\RequestInterface;
use Magento\Framework\HTTP\PhpEnvironment\RemoteAddress;
use Magento\Store\Model\StoreManagerInterface;

class CoreVariables implements VariablesDecoratorInterface
{
    const VARIABLE_STORE = '_store';
    const VARIABLE_IP = '_ip';
    const VARIABLE_REQUEST = '_request';

    /**
     * @var RemoteAddress
     */
    private $remoteAddress;

    /**
     * @var RequestInterface
     */
    private $request;

    /**
     * @var StoreManagerInterface
     */
    private $storeManager;

    /**
     * CoreDecorator constructor.
     * @param RemoteAddress $remoteAddress
     * @param RequestInterface $request
     * @param StoreManagerInterface $storeManager
     */
    public function __construct(
        RemoteAddress $remoteAddress,
        RequestInterface $request,
        StoreManagerInterface $storeManager
    ) {
        $this->remoteAddress = $remoteAddress;
        $this->request = $request;
        $this->storeManager = $storeManager;
    }

    /**
     * @inheritdoc
     */
    public function execute(array &$data)
    {
        $data[self::VARIABLE_STORE] = $this->storeManager->getStore();
        $data[self::VARIABLE_IP] = $this->remoteAddress->getRemoteAddress();
        $data[self::VARIABLE_REQUEST] = $this->request;
    }
}
