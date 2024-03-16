<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'tax_numbers')]
class TaxNumber
{
    #[ORM\Id]
    #[ORM\GeneratedValue('IDENTITY')]
    #[ORM\Column(type: Types::BIGINT)]
    private ?int $id = null;

    #[ORM\Column(type: Types::STRING, length: 255)]
    private ?string $number = null;


    #[ORM\Column(type: Types::FLOAT, columnDefinition: 'float CHECK (percent >= 0 AND percent <= 100)')]
    private float $percent = 0.0;

    public function getId(): int
    {
        return $this->id;
    }

    public function getPercent(): float
    {
        return $this->percent;
    }

    public function setPercent(float $percent): void
    {
        $this->percent = $percent;
    }

    public function setNumber(string $number): void
    {
        $this->number = $number;
    }


}