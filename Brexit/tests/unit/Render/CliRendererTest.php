<?php


namespace Anguis\Brexit\Tests\unit\Render;


use Anguis\Brexit\Entity\Product;
use Anguis\Brexit\Render\CliRenderer;
use Anguis\Brexit\Render\RendererInterface;
use PHPUnit\Framework\TestCase;


final class CliRendererTest extends TestCase
{

    public function testShouldImplementsProperInterface()
    {
        // Given
        $renderer = $this->createStub(CliRenderer::class);

        // Then
        $this->assertInstanceOf(RendererInterface::class, $renderer);
    }

    public function testShouldRenderProductsObjectToString()
    {
        // Given
        $products = array(
            new Product('test1',22.33, sellFactor: 1),
            new Product('test2',44.55, sellFactor: 5)
        );
        $renderer = new CliRenderer($products);
        $expected = "test1,22.33,1\ntest2,44.55,5\n";

        // Then
        $this->assertEquals($expected, $renderer->render());
    }

    public function testShouldShowPricesWithTwoDecimals()
    {
        // Given
        $products = array(
            new Product('test1',10, sellFactor: 1),
            new Product('test2',12.1111, sellFactor: 5)
        );
        $renderer = new CliRenderer($products);
        $expected = "test1,10.00,1\ntest2,12.11,5\n";

        // Then
        $this->assertEquals($expected, $renderer->render());
    }
}