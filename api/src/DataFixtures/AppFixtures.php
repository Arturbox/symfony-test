<?php

namespace App\DataFixtures;

use App\Entity\Coupon;
use App\Entity\Product;
use App\Entity\TaxNumber;
use App\Enum\CouponEnum;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\String\ByteString;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $j = 0;
        foreach ([
                     'DE123456789',
                     'IT123456789',
                     'IT123456789',
                     'GR123456789',
                     'FRAB123456789',
                 ] as $taxNumber) {
            $tax = new TaxNumber();
            $tax->setNumber($taxNumber);
            $tax->setPercent(mt_rand(0, 100));
            $manager->persist($tax);

            for ($i = 0; $i < 3; $i++) {
                $j++;
                $coupon = new Coupon();
                $coupon->setCode(ByteString::fromRandom(12)->toString());
                $coupon->setAmount(mt_rand(0, 100));
                $coupon->setType($i % 2 ? CouponEnum::Fix : CouponEnum::Percent);

                $manager->persist($coupon);

                $product = new Product();
                $product->setName('product ' . $j);
                $product->setPrice(mt_rand(0, 1000));
                $product->setCoupon($coupon);
                $manager->persist($product);
            }
        }
        $manager->flush();
    }
}