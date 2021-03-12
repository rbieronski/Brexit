<?php


namespace Anguis\Brexit\Processor\Searcher;


class ALetterProducts implements SearcherInterface
{

    public function search(array $products): array
    {
        $filtered = [];
        foreach ($products as $product) {
            if (strtoupper($product->getId()[0]) == "A") {
                $filtered[] = $product;
            }
        }
        return $filtered;
    }
}