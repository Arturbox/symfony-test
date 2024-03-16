<?php

namespace App\Service\PurchaseService;

use App\Enum\PaymentEnum;
use App\Exception\ServiceException;
use App\Service\PurchaseService\Context\PaymentContext;
use App\Service\PurchaseService\Strategy\PaypalPaymentProcessorStrategy;
use App\Service\PurchaseService\Strategy\StripePaymentProcessorStrategy;

readonly final class PurchaseService
{
    public function __construct(private PaymentContext $paymentContext)
    {

    }

    public function pay(string $type, $price): bool
    {
        try {
            if ($type == PaymentEnum::Stripe->value) {
                $this->paymentContext->setStrategy(new StripePaymentProcessorStrategy());
            } else {
                $this->paymentContext->setStrategy(new PaypalPaymentProcessorStrategy());
            }

            return $this->paymentContext->doPay($price);
        } catch (\Throwable $e) {
            throw new ServiceException($e->getMessage());
        }
    }

}