<?php

namespace App\DTO\Purchase;

use App\Enum\PaymentEnum;

final class PurchaseDTO
{

    public int $productId;
    public string $taxNumber;
    public ?string $couponCode;
    public PaymentEnum $type;

    public static function transform(int $product, string $taxNumber, string $paymentProcessor, ?string $couponCode = null): self
    {
        $dto = new self();
        $dto->productId = $product;
        $dto->taxNumber = $taxNumber;
        $dto->couponCode = $couponCode;
        $dto->type = PaymentEnum::tryFrom($paymentProcessor);

        return $dto;
    }

}