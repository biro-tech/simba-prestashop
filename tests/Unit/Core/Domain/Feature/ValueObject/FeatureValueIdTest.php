<?php
/**
 * For the full copyright and license information, please view the
 * docs/licenses/LICENSE.txt file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Tests\Unit\Core\Domain\Feature\ValueObject;

use Generator;
use PHPUnit\Framework\TestCase;
use PrestaShop\PrestaShop\Core\Domain\Feature\Exception\InvalidFeatureValueIdException;
use PrestaShop\PrestaShop\Core\Domain\Feature\ValueObject\FeatureValueId;

class FeatureValueIdTest extends TestCase
{
    /**
     * @dataProvider getValidValues
     */
    public function testItIsCreatedWithValidValue(int $value): void
    {
        $featureValueId = new FeatureValueId($value);

        $this->assertEquals($value, $featureValueId->getValue());
    }

    /**
     * @dataProvider getInvalidValues
     */
    public function testItThrowsExceptionWhenInvalidValueIsProvided(int $value): void
    {
        $this->expectException(InvalidFeatureValueIdException::class);

        new FeatureValueId($value);
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
