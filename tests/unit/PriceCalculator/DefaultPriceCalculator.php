<?php declare(strict_types=1);


namespace Anguis\Brexit\Tests\unit\PriceCalculator;

use PHPUnit\Framework\TestCase;
use
use


class DefaultPriceCalculator extends \PHPUnit\Framework\TestCase
{

    public function testImplementsProperInterface()
    {
        $this->assertInstanceOf(
            SaleableIndexPriceModifierDetectorTest::class,
            new SaleableIndexPriceModifierDetector
        );
    }

}