<?php


namespace Anguis\Brexit\Processor\Searcher;


class BestSaleableProducts implements SearcherInterface
{

    public function search(array $products): array
    {
        $filtered = [];
        foreach ($products as $product) {
            if ($product->getSellFactor() >= 4) {
                $filtered[] = $product;
            }
        }
        return $filtered;
    }
}