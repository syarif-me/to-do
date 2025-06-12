<?php

namespace App\Services;

use App\Models\Todo;
use App\Repositories\TodoRepository;
use App\Services\Interfaces\TodoServiceInterface;

class TodoService implements TodoServiceInterface
{
    protected TodoRepository $repository;

    function __construct(TodoRepository $repository)
    {
        $this->repository = $repository;
    }
	
    function create(array $data): Todo
	{
		return $this->repository->create($data);
	}
}