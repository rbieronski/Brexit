<?php


namespace Anguis\Brexit\PriceCalculation\ModifierDetector;


final class SellCategoryModifiers
{
    public const BAD_SALEABLE = 1.05;
    public const MEDIUM_SALEABLE = 1.15;
    public const WELL_SALEABLE = 1.1;

    private function __construct() {}
}