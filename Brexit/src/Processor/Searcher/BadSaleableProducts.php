<?php


namespace Anguis\Brexit\Processor\Searcher;


class BadSaleableProducts implements SearcherInterface
{

    public function search(array $products): array
    {
        $filtered = [];
        foreach ($products as $product) {
            if ($product->getSellFactor() == 1) {
                $filtered[] = $product;
            }
        }
        return $filtered;
    }
}