<?php


namespace Anguis\Brexit\Tests\unit\Processor\Search;

use Anguis\Brexit\Entity\Product;
use Anguis\Brexit\Processor\Searcher\SearcherInterface;
use Anguis\Brexit\Processor\Searcher\BadSaleableProducts;
use PHPUnit\Framework\TestCase;


class BadSaleableProductsTest extends TestCase
{

    public function testShouldImplementsProperInterface()
    {
        // Given
        $searcher = $this->createStub(BadSaleableProducts::class);

        // Then
        $this->assertInstanceOf(SearcherInterface::class, $searcher);
    }

    public function testShouldFoundBadSaleableProducts()
    {
        // Given
        $product1 = new Product('bbb-001', 19.99, 1);   // should be first match
        $product2 = new Product('Acc-002', 8.00, 2);    // should be skipped
        $product3 = new Product('agg-003', 77.22, 1);   // should be second match
        $products = array($product1, $product2, $product3);

        $searcher = new BadSaleableProducts();
        $matches = $searcher->search($products);
        $upperCaseFound = $matches[0];
        $lowerCaseFound = $matches[1];

        // Then
        $this->assertSame($product1, $upperCaseFound);
        $this->assertSame($product3, $lowerCaseFound);
    }
}