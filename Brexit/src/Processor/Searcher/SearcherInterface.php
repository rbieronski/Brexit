<?php

namespace Anguis\Brexit\Processor\Searcher;

use Anguis\Brexit\Entity\Product;


interface SearcherInterface
{
    /** @var $products Product[] */
    public function search(array $products): array;
}