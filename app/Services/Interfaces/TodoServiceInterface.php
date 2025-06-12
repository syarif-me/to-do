<?php

namespace App\Services\Interfaces;

use App\Models\Todo;

interface TodoServiceInterface
{
    function create(array $data): Todo;
}