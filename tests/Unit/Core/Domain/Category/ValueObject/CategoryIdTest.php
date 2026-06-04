<?php
/**
 * For the full copyright and license information, please view the
 * docs/licenses/LICENSE.txt file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Tests\Unit\Core\Domain\Category\ValueObject;

use Generator;
use PHPUnit\Framework\TestCase;
use PrestaShop\PrestaShop\Core\Domain\Category\Exception\CategoryException;
use PrestaShop\PrestaShop\Core\Domain\Category\ValueObject\CategoryId;

class CategoryIdTest extends TestCase
{
    /**
     * @dataProvider getValidValues
     */
    public function testItIsCreatedWithValidValue(int $value): void
    {
        $categoryId = new CategoryId($value);

        $this->assertEquals($value, $categoryId->getValue());
    }

    /**
     * @dataProvider getInvalidValues
     *
     * @param mixed $value
     */
    public function testItThrowsExceptionWhenInvalidValueIsProvided($value): void
    {
        $this->expectException(CategoryException::class);

        new CategoryId($value);
    }

    public function testIsEqual(): void
    {
        $id1 = new CategoryId(5);
        $id2 = new CategoryId(5);
        $id3 = new CategoryId(10);

        $this->assertTrue($id1->isEqual($id2));
        $this->assertFalse($id1->isEqual($id3));
    }

    public function getValidValues(): Generator
    {
        yield [1];
        yield [5];
        yield [100];
    }

    public function getInvalidValues(): Generator
    {
        yield [0];
        yield [-1];
        yield [-100];
    }
}
