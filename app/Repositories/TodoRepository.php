<?php

namespace App\Repositories;

use App\Models\Todo;
use App\Repositories\Interfaces\TodoRepositoryInterface;
use Illuminate\Http\Request;

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

    public function getTodosQuery(Request $request)
    {
        $query = $this->model->query();

        if ($request->filled('title')) {
            $query->where('title', 'like', '%' . $request->title . '%');
        }

        if ($request->filled('assignee')) {
            $assignees = explode(',', $request->assignee);
            $query->whereIn('assignee', $assignees);
        }

        if ($request->filled('status')) {
            $query->whereIn('status', explode(',', $request->status));
        }

        if ($request->filled('priority')) {
            $query->whereIn('priority', explode(',', $request->priority));
        }

        if ($request->filled('start') && $request->filled('end')) {
            $query->whereBetween('due_date', [$request->start, $request->end]);
        }

        if ($request->filled('min') && $request->filled('max')) {
            $query->whereBetween('time_tracked', [$request->min, $request->max]);
        }

        return $query;
    }
}