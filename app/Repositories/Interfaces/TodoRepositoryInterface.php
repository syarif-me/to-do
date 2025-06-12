<?php

namespace App\Repositories\Interfaces;

use App\Models\Todo;
use Illuminate\Http\Request;

interface TodoRepositoryInterface
{
    function create(array $data): Todo;
    function getTodosQuery(Request $request);
}