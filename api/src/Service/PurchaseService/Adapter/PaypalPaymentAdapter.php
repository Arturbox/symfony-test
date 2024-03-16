<?php

namespace App\Service\PurchaseService\Adapter;

use App\Service\PurchaseService\Strategy\PaypalPaymentProcessorStrategy;

class PaypalPaymentAdapter
{

    public function __construct(private PaypalPaymentProcessorStrategy $paypalPaymentProcessorStrategy)
    {
    }

    public function doPay(float $price): bool
    {
        try {
            $this->paypalPaymentProcessorStrategy->pay((int)$price);
            return true;
        } catch (\Throwable) {
            return false;
        }
    }

}