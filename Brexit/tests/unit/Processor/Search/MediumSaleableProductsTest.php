<?php


namespace Anguis\Brexit\Tests\unit\Processor\Search;

use Anguis\Brexit\Entity\Product;
use Anguis\Brexit\Processor\Searcher\SearcherInterface;
use Anguis\Brexit\Processor\Searcher\MediumSaleableProducts;
use PHPUnit\Framework\TestCase;


class MediumSaleableProductsTest extends TestCase
{

    public function testShouldImplementsProperInterface()
    {
        // Given
        $searcher = $this->createStub(MediumSaleableProducts::class);

        // Then
        $this->assertInstanceOf(SearcherInterface::class, $searcher);
    }

    public function testShouldFoundBadSaleableProducts()
    {
        // Given
        $product1 = new Product('bbb-001', 19.99, 1);   // should be skipped
        $product2 = new Product('Acc-002', 8.00, 2);    // should be first match
        $product3 = new Product('agg-003', 77.22, 3);   // should be second match
        $product4 = new Product('agg-003', 77.22, 5);   // should be skipped
        $products = array($product1, $product2, $product3, $product4);

        $searcher = new MediumSaleableProducts();
        $matches = $searcher->search($products);
        $upperCaseFound = $matches[0];
        $lowerCaseFound = $matches[1];

        // Then
        $this->assertSame($product2, $upperCaseFound);
        $this->assertSame($product3, $lowerCaseFound);
    }
}