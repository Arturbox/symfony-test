<?php

namespace App\DTO\Calculate;

final class CalculateDTO
{

    public int $productId;
    public string $taxNumber;
    public ?string $couponCode;

    public static function transform(int $product, string $taxNumber, ?string $couponCode = null): self
    {
        $dto = new self();
        $dto->productId = $product;
        $dto->taxNumber = $taxNumber;
        $dto->couponCode = $couponCode;

        return $dto;
    }

}