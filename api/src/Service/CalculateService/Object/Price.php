<?php

namespace App\Service\CalculateService\Object;

class Price
{

    public array $parts = [];

    public function getPrice(): float
    {
        return array_sum($this->parts) ?: 0.0;
    }

}