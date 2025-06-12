<?php

namespace App\Repositories;

use App\Models\Todo;
use App\Repositories\Interfaces\TodoRepositoryInterface;

class TodoRepository implements TodoRepositoryInterface
{
    protected Todo $model;

    function __construct(Todo $todo)
    {
        $this->model = $todo;
    }

	function create(array $data): Todo
	{
		return $this->model->create($data);
	}
}