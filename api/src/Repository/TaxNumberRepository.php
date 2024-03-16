<?php

namespace App\Repository;

use App\Entity\TaxNumber;
use App\Repository\Interface\TaxNumberRepositoryInterface;
use Doctrine\Persistence\ManagerRegistry;

class TaxNumberRepository extends AbstractRepository implements TaxNumberRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TaxNumber::class);
    }

    public function findByNumber(string $number): ?TaxNumber
    {
        return $this->findOneBy(['number' => $number]);
    }

}