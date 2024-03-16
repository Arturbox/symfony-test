<?php

namespace App\Repository\Interface;

use App\Entity\Product;

interface ProductRepositoryInterface
{

    public function findById(int $id): ?Product;

}