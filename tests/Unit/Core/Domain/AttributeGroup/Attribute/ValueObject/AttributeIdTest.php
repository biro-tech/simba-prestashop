<?php
/**
 * For the full copyright and license information, please view the
 * docs/licenses/LICENSE.txt file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Tests\Unit\Core\Domain\AttributeGroup\Attribute\ValueObject;

use Generator;
use PHPUnit\Framework\TestCase;
use PrestaShop\PrestaShop\Core\Domain\AttributeGroup\Attribute\Exception\AttributeConstraintException;
use PrestaShop\PrestaShop\Core\Domain\AttributeGroup\Attribute\ValueObject\AttributeId;

class AttributeIdTest extends TestCase
{
    /**
     * @dataProvider getValidValues
     */
    public function testItIsCreatedWithValidValue(int $value): void
    {
        $attributeId = new AttributeId($value);

        $this->assertEquals($value, $attributeId->getValue());
    }

    /**
     * @dataProvider getInvalidValues
     */
    public function testItThrowsExceptionWhenInvalidValueIsProvided(int $value): void
    {
        $this->expectException(AttributeConstraintException::class);
        $this->expectExceptionCode(AttributeConstraintException::INVALID_ID);

        new AttributeId($value);
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
