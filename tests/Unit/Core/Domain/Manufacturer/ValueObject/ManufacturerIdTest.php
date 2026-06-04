<?php
/**
 * For the full copyright and license information, please view the
 * docs/licenses/LICENSE.txt file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Tests\Unit\Core\Domain\Manufacturer\ValueObject;

use Generator;
use PHPUnit\Framework\TestCase;
use PrestaShop\PrestaShop\Core\Domain\Manufacturer\Exception\ManufacturerConstraintException;
use PrestaShop\PrestaShop\Core\Domain\Manufacturer\ValueObject\ManufacturerId;

class ManufacturerIdTest extends TestCase
{
    /**
     * @dataProvider getValidValues
     */
    public function testItIsCreatedWithValidValue(int $value): void
    {
        $manufacturerId = new ManufacturerId($value);

        $this->assertEquals($value, $manufacturerId->getValue());
    }

    /**
     * @dataProvider getInvalidValues
     *
     * @param mixed $value
     */
    public function testItThrowsExceptionWhenInvalidValueIsProvided($value): void
    {
        $this->expectException(ManufacturerConstraintException::class);
        $this->expectExceptionCode(ManufacturerConstraintException::INVALID_ID);

        new ManufacturerId($value);
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
