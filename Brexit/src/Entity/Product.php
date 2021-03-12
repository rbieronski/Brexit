<?php

namespace Anguis\Brexit\Entity;


class Product
{

    protected string $id;
    protected float $price;
    protected float $sellFactor;


    public function __construct(string $id, float $price, float $sellFactor)
    {
        $this->id = $id;
        $this->price = $price;
        $this->sellFactor = $sellFactor;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getPriceInCurrency(float $exchangeRate): float
    {
        return ($this->price * $exchangeRate);
    }

    public function getSellFactor(): float
    {
        return $this->sellFactor;
    }
}