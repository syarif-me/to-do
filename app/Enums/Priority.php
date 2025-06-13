<?php

namespace App\Enums;

enum Priority: String
{
    case LOW = 'low';
    case MEDIUM = 'medium';
    case HIGH = 'high';
}