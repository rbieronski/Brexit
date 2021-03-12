<?php


namespace Anguis\Brexit\Repository;


use Anguis\Brexit\Entity\Product;
use Anguis\Brexit\Reader\ProductReaderInterface;


class ArrayProductRepository implements ProductRepositoryInterface
{

    const SELL_FACTOR_COLUMN_INDEX = 2;
    protected ProductReaderInterface $productReader;
    protected bool $sortDescendingBySellFactor;


    public function __construct(
        ProductReaderInterface $productReader,
        bool $sortDescendingBySellFactor
    ) {
        $this->productReader = $productReader;
        $this->sortDescendingBySellFactor = $sortDescendingBySellFactor;
    }

    /**
     * @return Product[]
     */
    public function findAll(): array
    {
        $data = $this->prepareReaderData();
        $repository = [];
        for ($i = 1; $i < count($data); $i++) {
            $id = $data[$i][0];
            $repository[$id] = new Product(
                id: $id,
                price: $data[$i][1],
                sellFactor: $data[$i][2]
            );
        }
        return $repository;
    }

    protected function prepareReaderData(): array
    {
        $data = $this->productReader->read();
        if ($this->sortDescendingBySellFactor) {
            usort($data, function ($a, $b) {
                return $b[self::SELL_FACTOR_COLUMN_INDEX]
                    <=> $a[self::SELL_FACTOR_COLUMN_INDEX];
            });
        }
        return $data;
    }
}