<?php
/**
 * For the full copyright and license information, please view the
 * docs/licenses/LICENSE.txt file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Tests\Unit\Core\Domain\Category\ValueObject;

use PHPUnit\Framework\TestCase;
use PrestaShop\PrestaShop\Core\Domain\Category\Exception\CategoryConstraintException;
use PrestaShop\PrestaShop\Core\Domain\Category\ValueObject\CategoryDeleteMode;

class CategoryDeleteModeTest extends TestCase
{
    public function testAssociateAndDisableMode(): void
    {
        $mode = new CategoryDeleteMode(CategoryDeleteMode::ASSOCIATE_PRODUCTS_WITH_PARENT_AND_DISABLE);

        $this->assertTrue($mode->shouldDisableProducts());
        $this->assertFalse($mode->shouldRemoveProducts());
    }

    public function testAssociateOnlyMode(): void
    {
        $mode = new CategoryDeleteMode(CategoryDeleteMode::ASSOCIATE_PRODUCTS_WITH_PARENT_ONLY);

        $this->assertFalse($mode->shouldDisableProducts());
        $this->assertFalse($mode->shouldRemoveProducts());
    }

    public function testRemoveAssociatedMode(): void
    {
        $mode = new CategoryDeleteMode(CategoryDeleteMode::REMOVE_ASSOCIATED_PRODUCTS);

        $this->assertTrue($mode->shouldRemoveProducts());
        $this->assertFalse($mode->shouldDisableProducts());
    }

    public function testItThrowsExceptionWhenInvalidModeIsProvided(): void
    {
        $this->expectException(CategoryConstraintException::class);
        $this->expectExceptionCode(CategoryConstraintException::INVALID_DELETE_MODE);

        new CategoryDeleteMode('invalid_mode');
    }
}
