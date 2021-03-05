<?php


namespace Anguis\Brexit\Repository;


interface ProductRepositoryInterface
{

    public function findAll(): array;

    public function getHeaders(): ?array;
}