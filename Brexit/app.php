<?php

require_once __DIR__ . '/vendor/autoload.php';

use Anguis\Brexit\Reader\CsvProductReader;
use Anguis\Brexit\Repository\ArrayProductRepository;
use Anguis\Brexit\Entity\ProcessorRule;
use Anguis\Brexit\Processor\{
    ProductProcessor,
    Modifier\PercentModifier,
    Searcher\ALetterProducts,
    Searcher\BestSaleableProducts,
    Searcher\MediumSaleableProducts,
    Searcher\BadSaleableProducts
};
use Anguis\Brexit\Render\CliRenderer;


$productsRepository = new ArrayProductRepository(
    productReader: new CsvProductReader($argv[1]),
    sortDescendingBySellFactor: true
);
$products = $productsRepository->findAll();

$processor = new ProductProcessor($products);
$processor->addRule(new ProcessorRule('Raise 10% when sellFactor 4-5', new BestSaleableProducts(), new PercentModifier(10.0)));
$processor->addRule(new ProcessorRule('Raise 15% when sellFactor 2-3', new MediumSaleableProducts(), new PercentModifier(15.0)));
$processor->addRule(new ProcessorRule('Raise 5% when sellFactor 1', new BadSaleableProducts(), new PercentModifier(5.0)));
$processor->addRule(new ProcessorRule('Discount 10% when name starts with A', new ALetterProducts(), new PercentModifier(-10.0)));

$renderer = new CliRenderer(
    products: $processor->run(),
    currencyRate: 1 / $argv[2],
);
echo $renderer->render();
