<?php

namespace App\Service\CalculateService\Interface;

interface BuilderInterface
{
    public function calculateProductPrice(): void;

    public function calculateCouponPrice(): void;

    public function calculateTaxPrice(): void;
}