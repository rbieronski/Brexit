<?php


namespace Anguis\Brexit\Repository;


use Anguis\Brexit\Entity\ProductEntity;
use Anguis\Brexit\Reader\ProductReaderInterface;


class ArrayProductRepository implements ProductRepositoryInterface
{
    const SELL_FACTOR_COLUMN_INDEX = 2;
    protected ProductReaderInterface $productReader;
    protected array $repository;

    protected array $readerData;
    protected bool $sortDescendingBySellFactor;
    protected bool $containsHeaderRow;


    public function __construct(
        ProductReaderInterface $productReader,
        bool $sortDescendingBySellFactor,
        bool $containsHeadersRow
    ) {
        $this->productReader = $productReader;
        $this->sortDescendingBySellFactor = $sortDescendingBySellFactor;
        $this->containsHeaderRow = $containsHeadersRow;
    }

    /**
     * @return ProductEntity[]
     */
    public function findAll(): array
    {
        $this->prepareReaderData();
        $firstIndex = $this->containsHeaderRow ? 1 : 0;

        for (
            $i = $firstIndex;
            $i < count($this->readerData);
            $i++
        ) {
            $this->repository[] = new ProductEntity(
                id: $this->readerData[$i][0],
                price: $this->readerData[$i][1],
                sell_factor: $this->readerData[$i][2]
            );
        }
        return $this->repository;
    }

    protected function prepareReaderData()
    {
        if (empty($this->readerData)) {

            $this->readerData = $this->productReader->read();
            if ($this->sortDescendingBySellFactor) {
                usort($this->readerData, function ($a, $b) {
                    return $b[self::SELL_FACTOR_COLUMN_INDEX]
                        <=> $a[self::SELL_FACTOR_COLUMN_INDEX];
                });
            }
        }
    }

    public function getHeaders(): ?array
    {
        $this->prepareReaderData();
        if ($this->containsHeaderRow) {
            return $this->readerData[0];
        }
        return null;
    }
}