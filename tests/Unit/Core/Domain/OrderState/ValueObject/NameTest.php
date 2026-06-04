<?php
/**
 * For the full copyright and license information, please view the
 * docs/licenses/LICENSE.txt file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Tests\Unit\Core\Domain\OrderState\ValueObject;

use Generator;
use PHPUnit\Framework\TestCase;
use PrestaShop\PrestaShop\Core\Domain\OrderState\Exception\OrderStateConstraintException;
use PrestaShop\PrestaShop\Core\Domain\OrderState\ValueObject\Name;

class NameTest extends TestCase
{
    /**
     * @dataProvider getValidNames
     */
    public function testItIsCreatedWithValidName(string $name): void
    {
        $nameVO = new Name($name);

        $this->assertEquals($name, $nameVO->getValue());
    }

    /**
     * @dataProvider getInvalidNames
     */
    public function testItThrowsExceptionWhenInvalidNameIsProvided(string $name): void
    {
        $this->expectException(OrderStateConstraintException::class);
        $this->expectExceptionCode(OrderStateConstraintException::INVALID_NAME);

        new Name($name);
    }

    public function testItThrowsExceptionWhenNameExceedsMaxLength(): void
    {
        $longName = str_repeat('a', Name::MAX_LENGTH + 1);

        $this->expectException(OrderStateConstraintException::class);
        $this->expectExceptionCode(OrderStateConstraintException::INVALID_NAME);

        new Name($longName);
    }

    public function testItAcceptsNameAtMaxLength(): void
    {
        $name = str_repeat('a', Name::MAX_LENGTH);
        $nameVO = new Name($name);

        $this->assertEquals($name, $nameVO->getValue());
    }

    public function getValidNames(): Generator
    {
        yield ['Awaiting payment'];
        yield ['Shipped'];
        yield ['Delivered'];
        yield ['Refunded'];
    }

    public function getInvalidNames(): Generator
    {
        yield ['Invalid<Name'];
        yield ['Invalid>Name'];
        yield ['Name with (brackets)'];
        yield ['Name@with@at'];
    }
}
