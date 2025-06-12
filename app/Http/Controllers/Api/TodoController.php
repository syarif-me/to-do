<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTodoRequest;
use App\Services\Interfaces\TodoServiceInterface;

class TodoController extends Controller
{
    protected TodoServiceInterface $service;

    function __construct(TodoServiceInterface $service)
    {
        $this->service = $service;    
    }

    function store(StoreTodoRequest $request)
    {
        $data = $request->validated();
        return $this->service->create($data);
    }
}
