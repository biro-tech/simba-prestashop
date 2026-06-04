<?php
/**
 * For the full copyright and license information, please view the
 * docs/licenses/LICENSE.txt file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Tests\Unit\Core\Domain\AttributeGroup\ValueObject;

use Generator;
use PHPUnit\Framework\TestCase;
use PrestaShop\PrestaShop\Core\Domain\AttributeGroup\Exception\InvalidAttributeGroupTypeException;
use PrestaShop\PrestaShop\Core\Domain\AttributeGroup\ValueObject\AttributeGroupType;

class AttributeGroupTypeTest extends TestCase
{
    /**
     * @dataProvider getValidTypes
     */
    public function testItIsCreatedWithValidType(string $type): void
    {
        $groupType = new AttributeGroupType($type);

        $this->assertEquals($type, $groupType->getValue());
    }

    public function testItThrowsExceptionWhenInvalidTypeIsProvided(): void
    {
        $this->expectException(InvalidAttributeGroupTypeException::class);

        new AttributeGroupType('invalid_type');
    }

    public function getValidTypes(): Generator
    {
        yield [AttributeGroupType::ATTRIBUTE_GROUP_TYPE_SELECT];
        yield [AttributeGroupType::ATTRIBUTE_GROUP_TYPE_RADIO];
        yield [AttributeGroupType::ATTRIBUTE_GROUP_TYPE_COLOR];
    }
}
