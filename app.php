<?php

require_once __DIR__ . '/vendor/autoload.php';

use Anguis\Brexit\ModifierDetector\SellFactorPriceModifierDetector;
use Anguis\Brexit\PriceCalculation\DefaultPriceCalculation;

$newPriceCalculation = new DefaultPriceCalculation(
    new SellFactorPriceModifierDetector(),
    $argv[1]
);

echo $newPriceCalculation->recalculate(14.50, 3);
