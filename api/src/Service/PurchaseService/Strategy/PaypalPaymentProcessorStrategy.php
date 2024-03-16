<?php

namespace App\Service\PurchaseService\Strategy;

use App\Service\PurchaseService\Adapter\PaypalPaymentAdapter;
use App\Service\PurchaseService\Interface\PaymentStrategyInterface;
use Systemeio\TestForCandidates\PaymentProcessor\PaypalPaymentProcessor;

class PaypalPaymentProcessorStrategy extends PaypalPaymentProcessor implements PaymentStrategyInterface
{

    public function doPay(float $price): bool
    {
        $adapter = new PaypalPaymentAdapter($this);

        return $adapter->doPay($price);
    }

}