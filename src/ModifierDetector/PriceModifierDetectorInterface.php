<?php


namespace Anguis\Brexit\ModifierDetector;


interface PriceModifierDetectorInterface
{
    public function detectModifier($sellFactor): float;
}