<?php

require_once __DIR__ . '/vendor/autoload.php';

use Anguis\Brexit\ModifierDetector\SellFactorPriceModifierDetector;
use Anguis\Brexit\PriceCalculation\DefaultPriceCalculation;
use Anguis\Brexit\Reader\CsvProductReader;
use Anguis\Brexit\Repository\ArrayProductRepository;

//$newPriceCalculation = new DefaultPriceCalculation(
//    new SellFactorPriceModifierDetector(),
//    $argv[1]
//);
//
//echo $newPriceCalculation->recalculate(14.50, 3);

$reader = new CsvProductReader($argv[1]);

$repository = new ArrayProductRepository($reader, true, true);
$priceCalculation = new DefaultPriceCalculation(
    new \Anguis\Brexit\PriceCalculation\ModifierDetector\SellFactorPriceModifierDetector(),
    $argv[2]
);
$render = new \Anguis\Brexit\Renderer\CliRenderer(
    $repository, $priceCalculation
);
echo $render->render();





