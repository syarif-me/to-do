<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class TodoExport implements FromView
{
    protected $todos;
    protected $summary;

    public function __construct($todos, $summary)
    {
        $this->todos = $todos;
        $this->summary = $summary;
    }

    public function view(): View
    {
        return view('exports.todo', [
            'todos' => $this->todos,
            'summary' => $this->summary,
        ]);
    }
}