<?php

namespace App\Service\CalculateService;

use App\Exception\RepositoryException;
use App\Exception\ServiceException;
use App\Repository\Interface\ProductRepositoryInterface;
use App\Repository\Interface\TaxNumberRepositoryInterface;
use App\Service\CalculateService\Builder\CalculatePriceBuilder;
use App\Service\CalculateService\Manager\CalculateManager;

readonly final class CalculateService
{
    public function __construct(
        private CalculateManager             $manager,
        private ProductRepositoryInterface   $productRepository,
        private TaxNumberRepositoryInterface $taxNumberRepository
    )
    {

    }

    /**
     * @throws \Exception
     */
    public function calculatePrice(int $productId, string $taxNumber, ?string $couponCode): float
    {
        if (($product = $this->productRepository->findById($productId)) == null) {
            throw new RepositoryException('Product not found');
        }
        if (($tax = $this->taxNumberRepository->findByNumber($taxNumber)) == null) {
            throw new RepositoryException('Tax not found');
        }

        $coupon = $couponCode != null ? (
        $product->checkCouponByCode($couponCode) ? $product->getCoupon() : throw new RepositoryException('Coupon not found or expired')
        ) : null;

        try {
            $builder = new CalculatePriceBuilder($product, $tax, $coupon);
            $this->manager->setBuilder($builder);
            $this->manager->calculatePrice();

            return $builder->getProduct()->getPrice();
        } catch (\Throwable $e) {
            throw new ServiceException($e->getMessage());
        }
    }
}