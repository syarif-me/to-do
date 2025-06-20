<?php

namespace App\Repositories;

use App\Enums\Status;
use App\Enums\TodoChartType;
use App\Models\Todo;
use App\Repositories\Interfaces\TodoRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

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

    public function getSummary(string $type)
    {
        if (empty($type)) {
            throw new BadRequestException("type can't be null");
        }

        if ($type === TodoChartType::TYPE_ASSIGNEE->value) {
            return Todo::query()
                ->selectRaw('assignee')
                ->selectRaw('COUNT(*) as total_todos')
                ->selectRaw("SUM(CASE WHEN status = '" . Status::PENDING->value . "' THEN 1 ELSE 0 END) as total_pending_todos")
                ->selectRaw("SUM(CASE WHEN status = '" . Status::COMPLETED->value . "' THEN time_tracked ELSE 0 END) as total_timetracked_completed_todos")
                ->whereNotNull('assignee')
                ->groupBy('assignee')
                ->get()
                ->map(function ($row) {
                    return [
                        'assignee' => $row->assignee,
                        'total' => [
                            'total_todos' => $row->total_todos,
                            'total_pending_todos' => $row->total_pending_todos,
                            'total_timetracked_completed_todos' => $row->total_timetracked_completed_todos,
                        ],
                    ];
                })
                ->toArray();
        }

        $selectColumn  = '';
        if ($type === TodoChartType::TYPE_STATUS->value) {
            $selectColumn = 'status';
        } else if ($type === TodoChartType::TYPE_PRIORITY->value) {
            $selectColumn = 'priority';
        }

        return Todo::query()
            ->select($selectColumn, DB::raw('COUNT(id) AS total'))
            ->groupBy($selectColumn)
            ->get()
            ->map(function ($row) use ($selectColumn) {
                return [
                    $selectColumn => $row->{$selectColumn},
                    'total' => $row->total,
                ];
            })
            ->toArray();
    }

}