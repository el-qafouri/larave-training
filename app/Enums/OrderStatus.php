<?php

namespace App\Enums;

enum OrderStatus: string
{
    case PENDING = 'pending';
    case PAYING = 'pending_payment';
    case SUCCESS = 'payment_finished';
    case CANCELED = 'payment_canceled';
}
