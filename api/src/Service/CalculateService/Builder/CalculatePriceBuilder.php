<?php

namespace App\Service\CalculateService\Builder;

use App\Entity\Coupon;
use App\Entity\Product;
use App\Entity\TaxNumber;
use App\Enum\CouponEnum;
use App\Service\CalculateService\Interface\BuilderInterface;
use App\Service\CalculateService\Object\Price;

class CalculatePriceBuilder implements BuilderInterface
{

    private Price $price;

    public function __construct(protected Product $product, protected TaxNumber $tax, protected ?Coupon $coupon)
    {
        $this->reset();
    }

    public function reset(): void
    {
        $this->price = new Price();
    }

    public function calculateProductPrice(): void
    {
        $this->price->parts[] = $this->product->getPrice();
    }

    public function calculateCouponPrice(): void
    {
        if ($this->coupon) {
            $sumPrice = array_sum($this->price->parts);
            if ($this->coupon->getType() == CouponEnum::Fix->value) {
                $this->price->parts[] = $sumPrice + $this->coupon->getAmount();
            } else {
                $this->price->parts[] = ($sumPrice * $this->coupon->getAmount()) / 100;
            }
        } else {
            $this->price->parts[] = 0.0;
        }
    }

    public function calculateTaxPrice(): void
    {
        $sumPrice = array_sum($this->price->parts);
        $this->price->parts[] = ($sumPrice * $this->tax->getPercent()) / 100;
    }

    public function getProduct(): Price
    {
        $result = $this->price;
        $this->reset();

        return $result;
    }
}