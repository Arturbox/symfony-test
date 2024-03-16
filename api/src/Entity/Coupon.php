<?php

namespace App\Entity;

use App\Enum\CouponEnum;
use App\Repository\CouponRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CouponRepository::class)]
#[ORM\Table(name: 'coupons')]
class Coupon
{
    #[ORM\Id]
    #[ORM\GeneratedValue('IDENTITY')]
    #[ORM\Column(type: Types::BIGINT)]
    private ?int $id = null;

    #[ORM\Column(type: Types::STRING, length: 255)]
    private ?string $code = null;

    #[ORM\Column(type: Types::STRING, enumType: CouponEnum::class)]
    private CouponEnum|null $type = null;

    #[ORM\Column(type: Types::FLOAT)]
    private float $amount = 0.0;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTime $expiredAt = null;

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function getType(): ?CouponEnum
    {
        return $this->type;
    }

    public function isExpired(): bool
    {
        return (bool)$this->expiredAt;
    }

    public function setAmount(float $amount): void
    {
        $this->amount = $amount;
    }

    public function setCode(string $code): void
    {
        $this->code = $code;
    }

    public function setType(CouponEnum $type): void
    {
        $this->type = $type;
    }

}