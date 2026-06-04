<?php
/**
 * For the full copyright and license information, please view the
 * docs/licenses/LICENSE.txt file that was distributed with this source code.
 */

namespace Tests\Unit\Core\Security;

use PHPUnit\Framework\TestCase;
use PrestaShop\PrestaShop\Core\Security\Hashing;

class HashingTest extends TestCase
{
    public function testHash(): void
    {
        $hash = new Hashing();

        self::assertSame($hash->hash('some_data_to_hash', 'this_is_the_salt'), '6341b13ca966de51a6b2ab8bedd18304e41ae05215869d353cbb5e704ce7b4c9');
    }
}
