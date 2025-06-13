<?php

namespace App\Services\Interfaces;

use App\Models\Todo;
use Illuminate\Http\Request;

interface TodoServiceInterface
{
    function create(array $data): Todo;
    function getTodosQuery(Request $request);
    function getSummary(string $type);
}