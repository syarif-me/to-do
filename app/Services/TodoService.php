<?php

namespace App\Services;

use App\Models\Todo;
use App\Repositories\TodoRepository;
use App\Services\Interfaces\TodoServiceInterface;
use Illuminate\Http\Request;

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

    public function getTodosQuery(Request $request)
    {
        return $this->repository->getTodosQuery($request);
    }

    public function getSummary(string $type)
    {
        $summary = $this->repository->getSummary($type);

        $summaryKey = $type . '_summary';
        $summaryDetail = collect($summary)->pluck('total', $type)->toArray();

        return [
            $summaryKey => $summaryDetail
        ];
    }
}