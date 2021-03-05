<?php


namespace Anguis\Brexit\PriceCalculation;


use Anguis\Brexit\PriceCalculation\ModifierDetector\PriceModifierDetectorInterface;
use Anguis\Brexit\PriceCalculation\ModifierDetector\SellFactorPriceModifierDetector;


class DefaultPriceCalculation implements PriceCalculationInterface
{

    protected PriceModifierDetectorInterface $priceModifierDetector;
    protected float $exchangeCurrencyRate;


    public function __construct(
        PriceModifierDetectorInterface $priceModifierDetector,
        float $exchangeCurrencyRate
    ) {
        $this->priceModifierDetector = $priceModifierDetector;
        $this->exchangeCurrencyRate = $exchangeCurrencyRate;
    }

    public function recalculate(float $price, float $sellFactor): float
    {
        $modifier = $this->priceModifierDetector->detectModifier($sellFactor);
        return ($price / $this->exchangeCurrencyRate * $modifier);
    }
}