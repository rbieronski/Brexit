<?php


namespace Anguis\Brexit\PriceModifierDetector;


interface PriceModifierDetectorInterface
{
    public function detectPriceModifier(int $productSaleableIndex): float;
}