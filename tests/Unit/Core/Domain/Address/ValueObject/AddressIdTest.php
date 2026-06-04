<?php
/**
 * For the full copyright and license information, please view the
 * docs/licenses/LICENSE.txt file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Tests\Unit\Core\Domain\Address\ValueObject;

use Generator;
use PHPUnit\Framework\TestCase;
use PrestaShop\PrestaShop\Core\Domain\Address\Exception\AddressConstraintException;
use PrestaShop\PrestaShop\Core\Domain\Address\ValueObject\AddressId;

class AddressIdTest extends TestCase
{
    /**
     * @dataProvider getValidValues
     */
    public function testItIsCreatedWithValidValue(int $value): void
    {
        $addressId = new AddressId($value);

        $this->assertEquals($value, $addressId->getValue());
    }

    /**
     * @dataProvider getInvalidValues
     *
     * @param mixed $value
     */
    public function testItThrowsExceptionWhenInvalidValueIsProvided($value): void
    {
        $this->expectException(AddressConstraintException::class);
        $this->expectExceptionCode(AddressConstraintException::INVALID_ID);

        new AddressId($value);
    }

    public function getValidValues(): Generator
    {
        yield [1];
        yield [10];
        yield [999];
    }

    public function getInvalidValues(): Generator
    {
        yield [0];
        yield [-1];
        yield [-100];
    }
}
