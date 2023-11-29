<?php
/**
 * Automatically created by MageSpecialist CodeMonkey
 * https://github.com/magespecialist/m2-MSP_CodeMonkey
 */

declare(strict_types=1);

namespace MSP\NotifierTemplate\Test\Integration;

use Magento\TestFramework\Helper\Bootstrap;
use MSP\NotifierTemplate\Model\GetMessageTextInterface;

class TemplateTest extends \PHPUnit\Framework\TestCase
{
    /** @var GetMessageTextInterface */
    private $getMessageText;

    /**
     * @inheritdoc
     */
    public function setUp(): void
    {
        // @codingStandardsIgnoreStart
        $this->getMessageText = Bootstrap::getObjectManager()->get(
            GetMessageTextInterface::class
        );
        // @codingStandardsIgnoreEnd
    }

    /**
     * Creates a bunch of items, then retrieve them from DB and compare to original information
     */
    public function testTemplate()
    {
        $this->assertEquals(
            'TEST',
            $this->getMessageText->execute('', '_default', [
                '_title' => 'TEST',
            ])
        );
    }
}
