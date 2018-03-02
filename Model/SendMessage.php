<?php
/**
 * Copyright © MageSpecialist - Skeeller srl. All rights reserved.
 * See COPYING.txt for license details.
 */

declare(strict_types=1);

namespace MSP\NotifierTemplate\Model;

use MSP\NotifierTemplateApi\Api\SendMessageInterface;

class SendMessage implements SendMessageInterface
{
    /**
     * @var GetMessageTextInterface
     */
    private $getMessageText;

    /**
     * @var \MSP\NotifierApi\Api\SendMessageInterface
     */
    private $sendMessage;

    /**
     * SendMessage constructor.
     * @param GetMessageTextInterface $getMessageText
     * @param \MSP\NotifierApi\Api\SendMessageInterface $sendMessage
     */
    public function __construct(
        GetMessageTextInterface $getMessageText,
        \MSP\NotifierApi\Api\SendMessageInterface $sendMessage
    ) {
        $this->getMessageText = $getMessageText;
        $this->sendMessage = $sendMessage;
    }

    /**
     * Send a template formatted message
     * @param string $channelCode
     * @param string $template
     * @param array $params
     * @return bool
     */
    public function execute(string $channelCode, string $template, array $params = []): bool
    {
        $message = $this->getMessageText->execute($channelCode, $template, $params);
        return $this->sendMessage->execute($channelCode, $message);
    }
}
