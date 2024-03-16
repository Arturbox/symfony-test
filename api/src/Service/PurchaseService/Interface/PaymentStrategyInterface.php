<?php

namespace App\Service\PurchaseService\Interface;

interface PaymentStrategyInterface
{
    public function doPay(float $price): bool;

}