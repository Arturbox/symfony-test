<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
#[ORM\Table(name: 'products')]
class Product
{
    #[ORM\Id]
    #[ORM\GeneratedValue('IDENTITY')]
    #[ORM\Column(type: Types::BIGINT)]
    private ?int $id = null;

    #[ORM\Column(type: Types::STRING, length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2, nullable: true)]
    private float $price = 0.0;

    #[ORM\OneToOne(targetEntity: Coupon::class, fetch: 'EAGER')]
    #[ORM\JoinColumn(nullable: true)]
    private ?Coupon $coupon = null;

    public function getId(): int
    {
        return $this->id;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getCoupon(): ?Coupon
    {
        return $this->coupon;
    }

    public function checkCouponByCode(string $code): bool
    {
        if ($coupon = $this->getCoupon()) {
            if ($coupon->getCode() == $code && !$coupon->isExpired()) {
                return true;
            }
        }
        return false;
    }

    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function setCoupon(Coupon $coupon): void
    {
        $this->coupon = $coupon;
    }

}