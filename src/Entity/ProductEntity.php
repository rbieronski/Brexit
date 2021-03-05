<?php


namespace Anguis\Brexit\Entity;


class ProductEntity
{
    protected string $id;
    protected float $price;
    protected float $sell_factor;


    public function __construct(
        string $id,
        float $price,
        float $sell_factor
    ) {
        $this->id = $id;
        $this->price = $price;
        $this->sell_factor = $sell_factor;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getSellFactor(): float
    {
        return $this->sell_factor;
    }
}