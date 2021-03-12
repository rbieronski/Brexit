<?php


namespace Anguis\Brexit\Processor\Searcher;


class MediumSaleableProducts implements SearcherInterface
{

    public function search(array $products): array
    {
        $filtered = [];
        foreach ($products as $product) {

            $sellFactor = $product->getSellFactor();
            if (
                $sellFactor >= 2
                && $sellFactor < 4
            ) {
                $filtered[] = $product;
            }
        }
        return $filtered;
    }
}