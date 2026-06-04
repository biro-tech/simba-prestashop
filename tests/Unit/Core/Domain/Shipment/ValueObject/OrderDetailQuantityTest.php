<?php
/**
 * For the full copyright and license information, please view the
 * docs/licenses/LICENSE.txt file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Tests\Unit\Core\Domain\Shipment\ValueObject;

use PHPUnit\Framework\TestCase;
use PrestaShop\PrestaShop\Core\Domain\Shipment\Exception\ShipmentException;
use PrestaShop\PrestaShop\Core\Domain\Shipment\ValueObject\OrderDetailQuantity;

class OrderDetailQuantityTest extends TestCase
{
    public function testItIsCreatedWithValidItems(): void
    {
        $items = [
            ['id_order_detail' => 1, 'quantity' => 2],
            ['id_order_detail' => 3, 'quantity' => 5],
        ];

        $orderDetailQuantity = new OrderDetailQuantity($items);

        $this->assertEquals($items, $orderDetailQuantity->getValue());
    }

    public function testItThrowsExceptionWhenItemMissesIdOrderDetail(): void
    {
        $this->expectException(ShipmentException::class);

        new OrderDetailQuantity([
            ['quantity' => 2],
        ]);
    }

    public function testItThrowsExceptionWhenItemMissesQuantity(): void
    {
        $this->expectException(ShipmentException::class);

        new OrderDetailQuantity([
            ['id_order_detail' => 1],
        ]);
    }

    public function testItAcceptsEmptyArray(): void
    {
        $orderDetailQuantity = new OrderDetailQuantity([]);

        $this->assertEquals([], $orderDetailQuantity->getValue());
    }
}
