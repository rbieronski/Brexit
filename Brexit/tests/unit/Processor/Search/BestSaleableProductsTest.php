<?php


namespace Anguis\Brexit\Tests\unit\Processor\Search;

use Anguis\Brexit\Entity\Product;
use Anguis\Brexit\Processor\Searcher\SearcherInterface;
use Anguis\Brexit\Processor\Searcher\BestSaleableProducts;
use PHPUnit\Framework\TestCase;


class BestSaleableProductsTest extends TestCase
{

    public function testShouldImplementsProperInterface()
    {
        // Given
        $searcher = $this->createStub(BestSaleableProducts::class);

        // Then
        $this->assertInstanceOf(SearcherInterface::class, $searcher);
    }

    public function testShouldFoundBadSaleableProducts()
    {
        // Given
        $product1 = new Product('bbb-001', 19.99, 4);   // should be first match
        $product2 = new Product('Acc-002', 8.00, 2);    // should be skipped
        $product3 = new Product('agg-003', 77.22, 3);   // should be skipped
        $product4 = new Product('agg-003', 77.22, 5);   // should be second match
        $products = array($product1, $product2, $product3, $product4);

        $searcher = new BestSaleableProducts();
        $matches = $searcher->search($products);
        $upperCaseFound = $matches[0];
        $lowerCaseFound = $matches[1];

        // Then
        $this->assertSame($product1, $upperCaseFound);
        $this->assertSame($product4, $lowerCaseFound);
    }
}