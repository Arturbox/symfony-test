<?php

namespace App\Service\PurchaseService\Context;

use App\Service\PurchaseService\Interface\PaymentStrategyInterface;

class PaymentContext
{
    private PaymentStrategyInterface $strategy;

    public function setStrategy(PaymentStrategyInterface $strategy): void
    {
        $this->strategy = $strategy;
    }

    public function doPay(float $price): bool
    {
        return $this->strategy->doPay($price);
    }
}