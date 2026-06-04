<?php
/**
 * For the full copyright and license information, please view the
 * docs/licenses/LICENSE.txt file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Tests\Unit\Core\Domain\Tax\ValueObject;

use Generator;
use PHPUnit\Framework\TestCase;
use PrestaShop\PrestaShop\Core\Domain\Tax\Exception\TaxConstraintException;
use PrestaShop\PrestaShop\Core\Domain\Tax\ValueObject\TaxId;

class TaxIdTest extends TestCase
{
    /**
     * @dataProvider getValidValues
     */
    public function testItIsCreatedWithValidValue(int $value): void
    {
        $taxId = new TaxId($value);

        $this->assertEquals($value, $taxId->getValue());
    }

    /**
     * @dataProvider getInvalidValues
     *
     * @param mixed $value
     */
    public function testItThrowsExceptionWhenInvalidValueIsProvided($value): void
    {
        $this->expectException(TaxConstraintException::class);
        $this->expectExceptionCode(TaxConstraintException::INVALID_ID);

        new TaxId($value);
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
