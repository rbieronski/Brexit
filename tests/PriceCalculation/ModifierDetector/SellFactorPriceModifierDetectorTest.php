<?php

namespace Anguis\Brexit\Tests\PriceCalculation\ModifierDetector;


use PHPUnit\Framework\TestCase;
use Anguis\Brexit\PriceCalculation\ModifierDetector\SellFactorNotRecognizedException;
use Anguis\Brexit\PriceCalculation\ModifierDetector\SellFactorPriceModifierDetector;
use Anguis\Brexit\PriceCalculation\ModifierDetector\PriceModifierDetectorInterface;


class SellFactorPriceModifierDetectorTest extends TestCase
{

    public function testShouldImplementsProperInterface()
    {
        // Given
        $detector = $this->createStub(SellFactorPriceModifierDetector::class);

        // Then
        $this->assertInstanceOf(PriceModifierDetectorInterface::class, $detector);
    }

    public function testShouldReturnPriceModifierForSellFactorEqualsOne()
    {
        // Given
        $detector = new SellFactorPriceModifierDetector();

        // When
        $modifier = $detector->detectModifier(1);

        // Then
        $this->assertEquals(1.05, $modifier);
    }

    public function testShouldReturnPriceModifiersForAnySellFactor()
    {
        // Given
        $detector = new SellFactorPriceModifierDetector();

        // When
        $modifier1 = $detector->detectModifier(1);
        $modifier2 = $detector->detectModifier(2);
        $modifier3 = $detector->detectModifier(3);
        $modifier4 = $detector->detectModifier(4);
        $modifier5 = $detector->detectModifier(5);

        // Then
        $this->assertEquals(1.05, $modifier1);
        $this->assertEquals(1.15, $modifier2);
        $this->assertEquals(1.15, $modifier3);
        $this->assertEquals(1.1, $modifier4);
        $this->assertEquals(1.1, $modifier5);
    }

    public function testShouldThrowExceptionForUnrecognizedSellFactor()
    {
        // Expect
        $this->expectException(SellFactorNotRecognizedException::class);
        $this->expectExceptionMessage('Sell factor: 0 not recognized.');

        // Given
        $detector = new SellFactorPriceModifierDetector();

        // When
        $classifyUnderTest = $detector->detectModifier(0);
    }
}