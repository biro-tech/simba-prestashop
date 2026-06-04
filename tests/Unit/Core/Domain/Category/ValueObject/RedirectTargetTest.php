<?php
/**
 * For the full copyright and license information, please view the
 * docs/licenses/LICENSE.txt file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Tests\Unit\Core\Domain\Category\ValueObject;

use Generator;
use PHPUnit\Framework\TestCase;
use PrestaShop\PrestaShop\Core\Domain\Category\Exception\CategoryConstraintException;
use PrestaShop\PrestaShop\Core\Domain\Category\ValueObject\RedirectTarget;

class RedirectTargetTest extends TestCase
{
    /**
     * @dataProvider getValidValues
     */
    public function testItIsCreatedWithValidValue(int $value): void
    {
        $redirectTarget = new RedirectTarget($value);

        $this->assertEquals($value, $redirectTarget->getValue());
    }

    public function testNoTarget(): void
    {
        $redirectTarget = new RedirectTarget(RedirectTarget::NO_TARGET);

        $this->assertTrue($redirectTarget->isNoTarget());
        $this->assertEquals(0, $redirectTarget->getValue());
    }

    public function testPositiveTargetIsNotNoTarget(): void
    {
        $redirectTarget = new RedirectTarget(5);

        $this->assertFalse($redirectTarget->isNoTarget());
    }

    public function testItThrowsExceptionWhenNegativeValueIsProvided(): void
    {
        $this->expectException(CategoryConstraintException::class);
        $this->expectExceptionCode(CategoryConstraintException::INVALID_REDIRECT_TARGET);

        new RedirectTarget(-1);
    }

    public function getValidValues(): Generator
    {
        yield [RedirectTarget::NO_TARGET];
        yield [1];
        yield [5];
        yield [100];
    }
}
