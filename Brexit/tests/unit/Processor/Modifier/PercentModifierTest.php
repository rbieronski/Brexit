<?php


namespace Anguis\Brexit\Tests\unit\Processor\Modifier;

use PHPUnit\Framework\TestCase;
use Anguis\Brexit\Entity\Product;
use Anguis\Brexit\Processor\Modifier\ModifierInterface;
use Anguis\Brexit\Processor\Modifier\PercentModifier;


final class PercentModifierTest extends TestCase
{

    public function testShouldImplementsProperInterface()
    {
        // Given
        $modifier = $this->createStub(PercentModifier::class);

        // Then
        $this->assertInstanceOf(ModifierInterface::class, $modifier);
    }

    public function testShouldReturnRecalculatedProductByGivenPercentageModifier()
    {
        // Given
        $product = new Product('test1',100.80, sellFactor: 1);
        $modifier = new PercentModifier(-10);
        $recalculatedPrice = $modifier->modify($product)->getPrice();

        // Then
        $this->assertEquals(90.72, $recalculatedPrice);
    }
}