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
use PrestaShop\PrestaShop\Core\Domain\Category\ValueObject\RedirectType;

class RedirectTypeTest extends TestCase
{
    /**
     * @dataProvider getValidTypes
     */
    public function testItIsCreatedWithValidType(string $type): void
    {
        $redirectType = new RedirectType($type);

        $this->assertEquals($type, $redirectType->getValue());
    }

    public function testItThrowsExceptionWhenInvalidTypeIsProvided(): void
    {
        $this->expectException(CategoryConstraintException::class);
        $this->expectExceptionCode(CategoryConstraintException::INVALID_REDIRECT_TYPE);

        new RedirectType('999');
    }

    public function testIsTypeNotFound(): void
    {
        $type = new RedirectType(RedirectType::TYPE_NOT_FOUND);

        $this->assertTrue($type->isTypeNotFound());
        $this->assertFalse($type->isTypeGone());
        $this->assertFalse($type->isCategoryType());
    }

    public function testIsTypeGone(): void
    {
        $type = new RedirectType(RedirectType::TYPE_GONE);

        $this->assertTrue($type->isTypeGone());
        $this->assertFalse($type->isTypeNotFound());
        $this->assertFalse($type->isCategoryType());
    }

    /**
     * @dataProvider getCategoryTypes
     */
    public function testIsCategoryType(string $typeValue): void
    {
        $type = new RedirectType($typeValue);

        $this->assertTrue($type->isCategoryType());
        $this->assertFalse($type->isTypeNotFound());
        $this->assertFalse($type->isTypeGone());
    }

    public function getValidTypes(): Generator
    {
        yield [RedirectType::TYPE_NOT_FOUND];
        yield [RedirectType::TYPE_GONE];
        yield [RedirectType::TYPE_PERMANENT];
        yield [RedirectType::TYPE_TEMPORARY];
    }

    public function getCategoryTypes(): Generator
    {
        yield [RedirectType::TYPE_PERMANENT];
        yield [RedirectType::TYPE_TEMPORARY];
    }
}
