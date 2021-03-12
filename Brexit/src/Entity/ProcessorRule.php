<?php

namespace Anguis\Brexit\Entity;

use Anguis\Brexit\Processor\Searcher\SearcherInterface;
use Anguis\Brexit\Processor\Modifier\ModifierInterface;


class ProcessorRule
{

    protected string $name;
    protected SearcherInterface $searcher;
    protected ModifierInterface $modifier;


    public function __construct(
        string $name,
        SearcherInterface $searcher,
        ModifierInterface $modifier
    ) {
        $this->name = $name;
        $this->searcher = $searcher;
        $this->modifier = $modifier;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getSearcher(): SearcherInterface
    {
        return $this->searcher;
    }

    public function getModifier(): ModifierInterface
    {
        return $this->modifier;
    }
}