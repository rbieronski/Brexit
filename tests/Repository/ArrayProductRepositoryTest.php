<?php


namespace Anguis\Brexit\Tests\Repository;


use Anguis\Brexit\Reader\CsvProductReader;
use Anguis\Brexit\Repository\ArrayProductRepository;
use Anguis\Brexit\Repository\ProductRepositoryInterface;

class ArrayProductRepositoryTest extends \PHPUnit\Framework\TestCase
{

    public function testShouldImplementsProperInterface()
    {
        // Given
        $repository = $this->createStub(ArrayProductRepository::class);

        // Then
        $this->assertInstanceOf(ProductRepositoryInterface::class, $repository);
    }

    public function testShouldBeAbleSortingBySpecifiedSellFactorExcludingHeadersRow()
    {
        // Given
        $givenArray = array(
            array('id', 'price', 'sell_factor'),
            array('1ST_PRODUCT', 11.20, 1),
            array('2ND_PRODUCT', 14.50, 3),
            array('3RD_PRODUCT', 23.66, 5)
        );
        $reader = $this->createMock(CsvProductReader::class);
        $reader->expects($this->exactly(3))
            ->method('read')
            ->willReturn($givenArray);
        $repository = new ArrayProductRepository($reader, true);

        // When
        $firstEntityProductId = $repository->findAll()[0]->getId();
        $secondEntityProductId = $repository->findAll()[1]->getId();
        $thirdEntityProductId = $repository->findAll()[2]->getId();

        // Then
        $this->assertEquals('3RD_PRODUCT', $firstEntityProductId);
        $this->assertEquals('2ND_PRODUCT', $secondEntityProductId);
        $this->assertEquals('1ST_PRODUCT', $thirdEntityProductId);
    }
}