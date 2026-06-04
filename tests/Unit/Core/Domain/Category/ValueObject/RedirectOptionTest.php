<?php
/**
 * For the full copyright and license information, please view the
 * docs/licenses/LICENSE.txt file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Tests\Unit\Core\Domain\Category\ValueObject;

use PHPUnit\Framework\TestCase;
use PrestaShop\PrestaShop\Core\Domain\Category\Exception\CategoryConstraintException;
use PrestaShop\PrestaShop\Core\Domain\Category\ValueObject\RedirectOption;
use PrestaShop\PrestaShop\Core\Domain\Category\ValueObject\RedirectTarget;
use PrestaShop\PrestaShop\Core\Domain\Category\ValueObject\RedirectType;

class RedirectOptionTest extends TestCase
{
    public function testItIsCreatedWithPermanentRedirectToCategoryTarget(): void
    {
        $option = new RedirectOption(RedirectType::TYPE_PERMANENT, 5);

        $this->assertEquals(RedirectType::TYPE_PERMANENT, $option->getRedirectType()->getValue());
        $this->assertEquals(5, $option->getRedirectTarget()->getValue());
    }

    public function testItIsCreatedWithTemporaryRedirectToCategoryTarget(): void
    {
        $option = new RedirectOption(RedirectType::TYPE_TEMPORARY, 10);

        $this->assertEquals(RedirectType::TYPE_TEMPORARY, $option->getRedirectType()->getValue());
        $this->assertEquals(10, $option->getRedirectTarget()->getValue());
    }

    public function testNotFoundTypeResetsTargetToNoTarget(): void
    {
        $option = new RedirectOption(RedirectType::TYPE_NOT_FOUND, 5);

        $this->assertTrue($option->getRedirectType()->isTypeNotFound());
        $this->assertEquals(RedirectTarget::NO_TARGET, $option->getRedirectTarget()->getValue());
    }

    public function testItThrowsExceptionWhenInvalidTypeIsProvided(): void
    {
        $this->expectException(CategoryConstraintException::class);

        new RedirectOption('invalid', 5);
    }
}
