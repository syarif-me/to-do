<?php

namespace App\Repositories\Interfaces;

use App\Models\Todo;

interface TodoRepositoryInterface
{
    function create(array $data): Todo;
}