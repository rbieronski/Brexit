<?php

namespace Anguis\Brexit\PriceCalculation\ModifierDetector;



class SellFactorPriceModifierDetector implements PriceModifierDetectorInterface
{
    public function detectModifier($sellFactor): float
    {
        switch ($sellFactor)
        {
            case 1:
                return SellCategoryModifiers::BAD_SALEABLE;
                break;
            case 2:
            case 3:
                return SellCategoryModifiers::MEDIUM_SALEABLE;
                break;
            case 4:
            case 5:
                return SellCategoryModifiers::WELL_SALEABLE;
                break;
            default:
                throw new SellFactorNotRecognizedException(
                    "Sell factor: $sellFactor not recognized."
                );
        }
    }
}