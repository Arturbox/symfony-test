<?php

namespace App\Service\PurchaseService\Strategy;

use App\Service\PurchaseService\Interface\PaymentStrategyInterface;
use Systemeio\TestForCandidates\PaymentProcessor\StripePaymentProcessor;

class StripePaymentProcessorStrategy extends StripePaymentProcessor implements PaymentStrategyInterface
{
    public function doPay(float $price): bool
    {
        return $this->processPayment($price);
    }

}