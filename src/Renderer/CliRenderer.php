<?php


namespace Anguis\Brexit\Renderer;


use Anguis\Brexit\Entity\ProductEntity;
use Anguis\Brexit\PriceCalculation\PriceCalculationInterface;
use Anguis\Brexit\Repository\ProductRepositoryInterface;

class CliRenderer implements RendererInterface
{

    const FIELDS_SEPARATOR = ',';
    protected ProductRepositoryInterface $productRepository;
    protected PriceCalculationInterface $priceCalculation;


    public function __construct(
        ProductRepositoryInterface $productRepository,
        PriceCalculationInterface $priceCalculation
    ) {
        $this->productRepository = $productRepository;
        $this->priceCalculation = $priceCalculation;
    }

    public function render(): string
    {
        $str = '';

        $headers = $this->productRepository->getHeaders();
        if (!is_null($headers)) {
            $headersCount = count($headers);
            for ($i = 0; $i < $headersCount; $i++) {
                $str .= $headers[$i];
                if ($i <> ($headersCount - 1)) {
                    $str .= self::FIELDS_SEPARATOR;
                } else {
                    $str .= PHP_EOL;
                }
            }
        }

        /** @var $product ProductEntity */
        foreach ($products = $this->productRepository->findAll() as $product) {

            $price = $this->priceCalculation->recalculate(
                $product->getPrice(),
                $product->getSellFactor()
            );

            $str .= $product->getId() . self::FIELDS_SEPARATOR;
            $str .= round($price,2) . self::FIELDS_SEPARATOR;
            $str .= $product->getSellFactor() . PHP_EOL;
        }
        return $str;
    }
}