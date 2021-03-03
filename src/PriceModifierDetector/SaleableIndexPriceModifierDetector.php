<?php


namespace Anguis\Brexit\PriceModifierDetector;


class SaleableIndexPriceModifierDetector implements PriceModifierDetectorInterface
{

    public function detectPriceModifier(int $productSaleableIndex): float
    {
        switch ($productSaleableIndex) {
            case 1:
                return 1.05;
                break;
            case 2:
            case 3:
                return 1.15;
                break;
            case 4:
            case 5:
                return 1.1;
                break;
        }
    }
}