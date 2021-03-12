<?php


namespace Anguis\Brexit\Render;


use Anguis\Brexit\Entity\Product;


class CliRenderer implements RendererInterface
{

    protected array $products;
    protected float $currencyRate;


    /** @var $products Product[] */
    public function __construct(array $products, float $currencyRate = 1)
    {
        $this->products = $products;
        $this->currencyRate = $currencyRate;
    }

    public function render(): string
    {
        $result = '';
        foreach ($this->products as $product) {
            $result .= $product->getId() . ',';
            $result .= number_format($product->getPriceInCurrency($this->currencyRate), 2)  . ',';
            $result .= $product->getSellFactor() . "\n";
        }
        return $result;
    }
}