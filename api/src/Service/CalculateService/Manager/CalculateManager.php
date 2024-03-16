<?php

namespace App\Service\CalculateService\Manager;

use App\Service\CalculateService\Interface\BuilderInterface;

class CalculateManager
{
    private BuilderInterface $builder;

    public function setBuilder(BuilderInterface $builder): void
    {
        $this->builder = $builder;
    }


    public function calculatePrice(): void
    {
        $this->builder->calculateProductPrice();
        $this->builder->calculateCouponPrice();
        $this->builder->calculateTaxPrice();
    }
}