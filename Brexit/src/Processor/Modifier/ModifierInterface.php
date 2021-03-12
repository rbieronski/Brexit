<?php

namespace Anguis\Brexit\Processor\Modifier;

use Anguis\Brexit\Entity\Product;


interface ModifierInterface
{

    public function modify(Product $product): Product;
}