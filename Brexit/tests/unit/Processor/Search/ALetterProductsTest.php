<?php


namespace Anguis\Brexit\Tests\unit\Processor\Search;

use PHPUnit\Framework\TestCase;
use Anguis\Brexit\Entity\Product;
use Anguis\Brexit\Processor\Searcher\ALetterProducts;
use Anguis\Brexit\Processor\Searcher\SearcherInterface;


final class ALetterProductsTest extends TestCase
{

    public function testShouldImplementsProperInterface()
    {
        // Given
        $searcher = $this->createStub(ALetterProducts::class);

        // Then
        $this->assertInstanceOf(SearcherInterface::class, $searcher);
    }

    public function testShouldFoundProductsStartingWithLetterA()
    {
        // Given
        $product1 = new Product('bbb-001', 19.99, 5);   // should be skipped
        $product2 = new Product('Acc-002', 8.00, 2);    // should be first match
        $product3 = new Product('agg-003', 77.22, 5);   // should be second match
        $products = array($product1, $product2, $product3);

        $searcher = new ALetterProducts();
        $matches = $searcher->search($products);
        $upperCaseFound = $matches[0];
        $lowerCaseFound = $matches[1];

        // Then
        $this->assertSame($product2, $upperCaseFound);
        $this->assertSame($product3, $lowerCaseFound);
    }
}