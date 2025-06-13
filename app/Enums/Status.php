<?php

namespace App\Enums;

enum Status: String
{
    case PENDING = 'pending';
    case OPEN = 'open';
    case IN_PROGRESS = 'in_progress';
    case COMPLETED = 'completed';
}