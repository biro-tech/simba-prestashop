<?php
/**
 * For the full copyright and license information, please view the
 * docs/licenses/LICENSE.txt file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Tests\Unit\Core\Domain\Shipment\ValueObject;

use Exception;
use PHPUnit\Framework\TestCase;
use PrestaShop\PrestaShop\Core\Domain\Shipment\ValueObject\OrderDetailsId;

class OrderDetailsIdTest extends TestCase
{
    public function testItIsCreatedWithValidArray(): void
    {
        $ids = [1, 2, 3];
        $orderDetailsId = new OrderDetailsId($ids);

        $this->assertEquals($ids, $orderDetailsId->getValue());
    }

    public function testItThrowsExceptionWhenEmptyArrayIsProvided(): void
    {
        $this->expectException(Exception::class);

        new OrderDetailsId([]);
    }
}
