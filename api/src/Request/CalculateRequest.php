<?php

namespace App\Request;

use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Constraints\Type;

class CalculateRequest extends BaseRequest
{
    #[Type('integer')]
    #[NotBlank()]
    protected int $product;

    #[Type('string')]
    protected string $couponCode;

    #[Type('string')]
    #[NotBlank([])]
    #[Regex(pattern: '/^[A-Z]{2,4}[0-9]+$/')]
    protected string $taxNumber;
}