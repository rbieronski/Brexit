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
        $this->csvReader->expects($this->exactly(2))
            ->method('read')
            ->willReturn($arrCsv);
    }

    public function testShouldRenderUsingGivenCsvStringWithAndWithoutSorting()
    {
        // Given
        $repositorySorted = new ArrayProductRepository(
            productReader: $this->csvReader,
            sortDescendingBySellFactor: true,
            containsHeadersRow: true
        );
        $repositoryUnsorted = new ArrayProductRepository(
            productReader: $this->csvReader,
            sortDescendingBySellFactor: false,
            containsHeadersRow: true
        );
        $priceCalculation = new DefaultPriceCalculation(
            priceModifierDetector: new SellFactorPriceModifierDetector(),
            exchangeCurrencyRate: 5.26
        );
        $rendererSorted = new CliRenderer($repositorySorted, $priceCalculation);
        $rendererUnsorted = new CliRenderer($repositoryUnsorted, $priceCalculation);

        // When
        $renderedSorted = $rendererSorted->render();
        $renderedUnsorted = $rendererUnsorted->render();

        // Then
        $expectedSorted = "id,price,sell_factor\nCD-532,4.95,5\nKK-781,3.17,3\nAS-500,2.24,1\n";
        $expectedUnsorted = "id,price,sell_factor\nAS-500,2.24,1\nCD-532,4.95,5\nKK-781,3.17,3\n";
        $this->assertEquals($expectedSorted, $renderedSorted);
        $this->assertEquals($expectedUnsorted, $renderedUnsorted);
    }
}