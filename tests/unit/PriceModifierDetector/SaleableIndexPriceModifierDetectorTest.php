<?php declare(strict_types=1);


namespace Anguis\Brexit\Tests\unit\PriceModifierDetector;

use PHPUnit\Framework\TestCase;
use Anguis\Brexit\PriceModifierDetector\PriceModifierDetectorInterface;
use Anguis\Brexit\PriceModifierDetector\SaleableIndexPriceModifierDetector;

final class SaleableIndexPriceModifierDetectorTest extends TestCase
{
    public function testImplementsProperInterface()
    {
        $this->assertInstanceOf(
            SaleableIndexPriceModifierDetector::class,
            new SaleableIndexPriceModifierDetector
        );
    }

    public function testDetectCorrectPriceModifiers()
    {
        //$detector = $this->createMock(SaleableIndexPriceModifierDetector::class);
        $detector = new SaleableIndexPriceModifierDetector();
        $result = $detector->detectPriceModifier(1);
        $this->assertSame(1.05, $result);

        $result = $detector->detectPriceModifier(3);
        $this->assertSame(1.15, $result);

        $result = $detector->detectPriceModifier(5);
        $this->assertSame(1.1, $result);

    }
//    public function testDetectCorrectPriceModifier2()
//    {
//        //        $detector->expects($this->once())
//        //            ->method('detectPriceModifier')
//        //            ->with(1)
//        //            ->willReturn(1.05);
//        //        $detector->expects($this->once(5))
//        //            ->method('detectPriceModifier')
//        //            ->withConsecutive([1, 2, 3, 4 ,5])
//        //            ->willReturnOnConsecutiveCalls(1.05, 1.15, 1.15, 1.1, 1.1);
//        echo "ok";
//    }
}