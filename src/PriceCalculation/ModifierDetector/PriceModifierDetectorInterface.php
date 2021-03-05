<?php


namespace Anguis\Brexit\PriceCalculation\ModifierDetector;


interface PriceModifierDetectorInterface
{
    public function detectModifier($sellFactor): float;
}