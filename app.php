<?php

require_once __DIR__ . '/vendor/autoload.php';

use Anguis\Brexit\PriceCalculation\DefaultPriceCalculation;
use Anguis\Brexit\PriceCalculation\ModifierDetector\SellFactorPriceModifierDetector;
use Anguis\Brexit\Reader\CsvProductReader;
use Anguis\Brexit\Renderer\CliRenderer;
use Anguis\Brexit\Repository\ArrayProductRepository;


$reader = new CsvProductReader($argv[1]);
$repository = new ArrayProductRepository(
    productReader: $reader,
    sortDescendingBySellFactor: true,
    containsHeadersRow: true);
$priceCalculation = new DefaultPriceCalculation(
    priceModifierDetector: new SellFactorPriceModifierDetector(),
    exchangeCurrencyRate: $argv[2]
);
$renderer = new CliRenderer($repository, $priceCalculation);
echo $renderer->render();





