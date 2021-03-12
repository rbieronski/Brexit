<?php

namespace Anguis\Brexit\Processor;

use Anguis\Brexit\Entity\Product;
use Anguis\Brexit\Entity\ProcessorRule;


class ProductProcessor implements ProcessorInterface
{

    /** @var $rules ProcessorRule[]  */
    protected array $rules = [];
    protected array $products;
    // TODO stop processing

    public function __construct(array $products)
    {
        $this->products = $products;
    }

    public function run(): array
    {
        foreach ($this->rules as $rule) {
            $products = $rule->getSearcher()->search($this->products);

            /** @var $products Product[] */
            foreach ($products as $product) {
                $this->products[$product->getId()] = $rule->getModifier()->modify($product);
            }
        }
        return $this->products;
    }

    public function addRule(ProcessorRule $rule): self
    {
        $this->rules[] = $rule;
        return $this;
    }
}