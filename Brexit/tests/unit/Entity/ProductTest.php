<?php


namespace Anguis\Brexit\Tests\unit\Entity;

use PHPUnit\Framework\TestCase;
use Anguis\Brexit\Entity\Product;


final class ProductTest extends TestCase
{

    public function testShouldCreateNewProductEntityWithGetters()
    {
        // Given
        $entity = new Product(id: 'test', price: 12.99, sellFactor: 4);

        // Then
        $this->assertEquals('test', $entity->getId());
        $this->assertEquals(12.99, $entity->getPrice());
        $this->assertEquals(4, $entity->getSellFactor());
    }

    public function testShouldAllowGetPriceInAnotherCurrencyByGivenExchangeRate()
    {
        // Given
        $product = new Product(
            id: 'test',
            price: 10,
            sellFactor: 0
        );
        $currencyExchangeRate = 0.5;

        // Then
        $this->assertEquals(5, $product->getPriceInCurrency($currencyExchangeRate));
    }
}