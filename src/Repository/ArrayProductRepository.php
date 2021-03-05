<?php


namespace Anguis\Brexit\Repository;


use Anguis\Brexit\Entity\ProductEntity;
use Anguis\Brexit\Reader\ProductReaderInterface;


class ArrayProductRepository implements ProductRepositoryInterface
{
    const SELL_FACTOR_COLUMN_INDEX = 2;
    protected ProductReaderInterface $productReader;
    protected array $repository;
    protected bool $sortDescendingBySellFactor;

    public function __construct(
        ProductReaderInterface $productReader,
        bool $sortDescendingBySellFactor
    ) {
        $this->productReader = $productReader;
        $this->sortDescendingBySellFactor = $sortDescendingBySellFactor;
    }

    /**
     * @return ProductEntity[]
     */
    public function findAll(): array
    {
        $arr = $this->productReader->read();
        if ($this->sortDescendingBySellFactor) {
            usort($arr, function($a, $b) {
                return $b[self::SELL_FACTOR_COLUMN_INDEX]
                    <=> $a[self::SELL_FACTOR_COLUMN_INDEX];
            });
        }
        foreach ($arr as $key=>$row) {
            if ($key <> 0) {
                $this->repository[] = new ProductEntity(
                    $row[0],
                    $row[1],
                    $row[2]
                );
            }
        }
        return $this->repository;
    }
}