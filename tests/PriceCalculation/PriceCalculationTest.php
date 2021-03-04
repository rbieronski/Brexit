<?php


namespace Anguis\Brexit\Tests\PriceCalculation;

use Anguis\Brexit\ModifierDetector\PriceModifierDetectorInterface;
use Anguis\Brexit\ModifierDetector\SellFactorPriceModifierDetector;
use Anguis\Brexit\PriceCalculation\NotValidExchangeCurrencyRateException;
use PHPUnit\Framework\TestCase;
use Anguis\Brexit\PriceCalculation\DefaultPriceCalculation;
use Anguis\Brexit\PriceCalculation\PriceCalculationInterface;


class PriceCalculationTest extends TestCase
{

    public function testShouldImplementsProperInterface()
    {
        // Given
        $calculation = $this->createStub(DefaultPriceCalculation::class);

        // Then
        $this->assertInstanceOf(PriceCalculationInterface::class, $calculation);
    }

    public function testShouldRecalculatePriceByGivenExchangeCurrencyRate()
    {
        // Given
        $detector = $this->createMock(SellFactorPriceModifierDetector::class);
        $detector->expects($this->once())
            ->method('detectModifier')
            ->willReturn(1.00);

        $calculation = new DefaultPriceCalculation(
            $detector,
            exchangeCurrencyRate: 11
        );

        // When
        $recalculatedPrice = $calculation->recalculate(33, 0);

        // Then
        $this->assertEquals(3.00, $recalculatedPrice);
    }

    public function testShouldRecalculatePriceByGivenExchangeCurrencyRateAndDetectedModifier()
    {
        // Given
        $detector = $this->createMock(SellFactorPriceModifierDetector::class);
        $detector->expects($this->once())
            ->method('detectModifier')
            ->willReturn(2.00);

        $calculation = new DefaultPriceCalculation(
            $detector,
            exchangeCurrencyRate: 11
        );

        // When
        $recalculatedPrice = $calculation->recalculate(33, 0);

        // Then
        $this->assertEquals(6.00, $recalculatedPrice);
    }
}