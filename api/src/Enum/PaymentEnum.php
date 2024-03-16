<?php

namespace App\Enum;

enum PaymentEnum: string
{
    case Paypal = 'paypal';
    case Stripe = 'stripe';
}