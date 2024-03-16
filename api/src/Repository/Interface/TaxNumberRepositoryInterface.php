<?php

namespace App\Repository\Interface;

use App\Entity\TaxNumber;

interface TaxNumberRepositoryInterface
{
    public function findByNumber(string $number): ?TaxNumber;

}