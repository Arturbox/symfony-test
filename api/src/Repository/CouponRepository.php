<?php

namespace App\Repository;

use App\Entity\Coupon;
use App\Repository\Interface\CouponRepositoryInterface;
use Doctrine\Persistence\ManagerRegistry;

class CouponRepository extends AbstractRepository implements CouponRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Coupon::class);
    }
}