<?php


namespace Anguis\Brexit\Processor\Modifier;

use Anguis\Brexit\Entity\Product;


class PercentModifier implements ModifierInterface
{

    protected float $percent;

    public function __construct(float $percent)
    {
        $this->percent = $percent;
    }

    public function modify(Product $product): Product
    {
        $newPrice = (1 + 0.01 * $this->percent) * ($product->getPrice());
        return new Product(
            id: $product->getId(),
            price: $newPrice,
            sellFactor: $product->getSellFactor()
        );
    }
}