<?php
/**
 * For the full copyright and license information, please view the
 * docs/licenses/LICENSE.txt file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Tests\Unit\Core\Domain\AttributeGroup\ValueObject;

use Generator;
use PHPUnit\Framework\TestCase;
use PrestaShop\PrestaShop\Core\Domain\AttributeGroup\Exception\AttributeGroupConstraintException;
use PrestaShop\PrestaShop\Core\Domain\AttributeGroup\ValueObject\AttributeGroupId;

class AttributeGroupIdTest extends TestCase
{
    /**
     * @dataProvider getValidValues
     */
    public function testItIsCreatedWithValidValue(int $value): void
    {
        $id = new AttributeGroupId($value);

        $this->assertEquals($value, $id->getValue());
    }

    /**
     * @dataProvider getInvalidValues
     */
    public function testItThrowsExceptionWhenInvalidValueIsProvided(int $value): void
    {
        $this->expectException(AttributeGroupConstraintException::class);
        $this->expectExceptionCode(AttributeGroupConstraintException::INVALID_ID);

        new AttributeGroupId($value);
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
