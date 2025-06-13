<?php

namespace App\Http\Controllers\Api;

use App\Exports\TodoExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTodoRequest;
use App\Services\Interfaces\TodoServiceInterface;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

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

    function export(Request $request)
    {
        $query = $this->service->getTodosQuery($request);

        $todos = $query->lazy();

        $summary = [
            'total' => $todos->count(),
            'total_time' => $todos->sum('time_tracked')
        ];

        return Excel::download(new TodoExport($todos, $summary), 'todos.xlsx');
    }

    function chart(Request $request)
    {
        return $this->service->getSummary($request->type);
    }
}
