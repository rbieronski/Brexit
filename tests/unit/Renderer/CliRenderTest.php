<?php


namespace Anguis\Brexit\Tests\unit\Renderer;

use PHPUnit\Framework\TestCase;
use Anguis\Brexit\Entity\ProductEntity;
use Anguis\Brexit\PriceCalculation\PriceCalculationInterface;
use Anguis\Brexit\Repository\ProductRepositoryInterface;
use Anguis\Brexit\Renderer\CliRenderer;
use Anguis\Brexit\Renderer\RendererInterface;


class CliRenderTest extends TestCase
{

    public function testShouldImplementsProperInterface()
    {
        // Given
        $repository = $this->createStub(ProductRepositoryInterface::class);
        $calculation = $this->createStub(PriceCalculationInterface::class);
        $renderer = new CliRenderer($repository, $calculation);

        // Then
        $this->assertInstanceOf(RendererInterface::class, $renderer);
    }

    public function testShouldReturnProperStringForOneProduct()
    {
        // Given
        $products = array(
            new ProductEntity('AB-CDE', 10, 2),
            new ProductEntity('ZX-XYZ', 15, 5)
        );
        $productRepository = $this->createMock(ProductRepositoryInterface::class);
        $productRepository
            ->method('findAll')
            ->willReturn($products);

        $priceCalculation = $this->createMock(PriceCalculationInterface::class);
        $renderer = new CliRenderer($productRepository, $priceCalculation);

        // When
        $renderer->render();

        // Then
        $this->assertEquals("AB-CDE,0,2\nZX-XYZ,0,5\n", $renderer->render());
    }

    public function testShouldRoundPriceToTwoDecimals()
    {
        // Given
        $products = array(
            new ProductEntity('AB-CDE', 10, 2)
        );
        $productRepository = $this->createMock(ProductRepositoryInterface::class);
        $productRepository
            ->method('findAll')
            ->willReturn($products);

        $priceCalculation = $this->createMock(PriceCalculationInterface::class);
        $priceCalculation
            ->method('recalculate')
            ->willReturn(4.111111);
        // TODO check why invoked 2 times

        $renderer = new CliRenderer($productRepository, $priceCalculation);

        // When
        $renderer->render();

        // Then
        $this->assertEquals("AB-CDE,4.11,2\n", $renderer->render());
    }
}