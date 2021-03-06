<?php


namespace Anguis\Brexit\Tests\integration;

use Anguis\Brexit\PriceCalculation\DefaultPriceCalculation;
use Anguis\Brexit\PriceCalculation\ModifierDetector\SellFactorPriceModifierDetector;
use Anguis\Brexit\Reader\ProductReaderInterface;
use Anguis\Brexit\Renderer\CliRenderer;
use Anguis\Brexit\Repository\ArrayProductRepository;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Anguis\Brexit\Reader\CsvProductReader;


final class CanRenderByGivenReaderCsvStringTest extends TestCase
{

    private MockObject $csvReader;


    public function setUp(): void
    {
        $arrCsv = array(
            array('id','price','sell_factor'),
            array('AS-500',11.20,1),
            array('CD-532',23.66,5),
            array('KK-781',14.50,3)
        );
        $this->csvReader = $this->createMock(ProductReaderInterface::class);
        $this->csvReader->expects($this->once())
            ->method('read')
            ->willReturn($arrCsv);
    }

    public function testShouldRenderUsingGivenCsvStringWithSorting()
    {
        // Given
        $repository = new ArrayProductRepository(
            productReader: $this->csvReader,
            sortDescendingBySellFactor: true,
            containsHeadersRow: true
        );
        $priceCalculation = new DefaultPriceCalculation(
            priceModifierDetector: new SellFactorPriceModifierDetector(),
            exchangeCurrencyRate: 5.26
        );
        $renderer = new CliRenderer($repository, $priceCalculation);

        // When
        $rendered = $renderer->render();

        // Then
        $expected = "id,price,sell_factor\nCD-532,4.95,5\nKK-781,3.17,3\nAS-500,2.24,1\n";
        $this->assertEquals($expected, $rendered);
    }
}