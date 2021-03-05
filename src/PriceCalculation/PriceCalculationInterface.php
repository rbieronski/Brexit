<?php


namespace Anguis\Brexit\PriceCalculation;


interface PriceCalculationInterface
{

    public function recalculate(float $price, float $modifier): float;
}