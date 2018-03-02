<?php
/**
 * Automatically created by MageSpecialist CodeMonkey
 * https://github.com/magespecialist/m2-MSP_CodeMonkey
 */

declare(strict_types=1);

namespace MSP\NotifierTemplate\Model;

use Magento\Framework\Model\AbstractExtensibleModel;

/**
 * @SuppressWarnings(PHPMD.CamelCaseMethodName)
 */
class DatabaseTemplate extends AbstractExtensibleModel implements
    \MSP\NotifierTemplateApi\Api\Data\DatabaseTemplateInterface
{
    /**
     * @inheritdoc
     */
    protected function _construct()
    {
        $this->_init(\MSP\NotifierTemplate\Model\ResourceModel\DatabaseTemplate::class);
    }

    /**
     * @inheritdoc
     */
    public function getCode()
    {
        return $this->getData(self::CODE);
    }

    /**
     * @inheritdoc
     */
    public function setCode($value)
    {
        return $this->setData(self::CODE, $value);
    }

    /**
     * @inheritdoc
     */
    public function getAdapterCode()
    {
        return $this->getData(self::ADAPTER_CODE);
    }

    /**
     * @inheritdoc
     */
    public function setAdapterCode($value)
    {
        return $this->setData(self::ADAPTER_CODE, $value);
    }

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return $this->getData(self::NAME);
    }

    /**
     * @inheritdoc
     */
    public function setName($value)
    {
        return $this->setData(self::NAME, $value);
    }

    /**
     * @inheritdoc
     */
    public function getTemplate()
    {
        return $this->getData(self::TEMPLATE);
    }

    /**
     * @inheritdoc
     */
    public function setTemplate($value)
    {
        return $this->setData(self::TEMPLATE, $value);
    }

    /**
     * @inheritdoc
     */
    public function getExtensionAttributes()
    {
        return $this->_getExtensionAttributes();
    }

    /**
     * @inheritdoc
     */
    public function setExtensionAttributes(
        \MSP\NotifierTemplateApi\Api\Data\DatabaseTemplateExtensionInterface $extensionAttributes
    ) {
        $this->_setExtensionAttributes($extensionAttributes);
    }
}
