{{-- resources/views/exports/todos.blade.php --}}
<table>
    <thead>
        <tr>
            <th>Title</th>
            <th>Assignee</th>
            <th>Due Date</th>
            <th>Time Tracked</th>
            <th>Status</th>
            <th>Priority</th>
        </tr>
    </thead>
    <tbody>
        @foreach($todos as $todo)
            <tr>
                <td>{{ $todo->title }}</td>
                <td>{{ $todo->assignee }}</td>
                <td>{{ $todo->due_date }}</td>
                <td>{{ $todo->time_tracked }}</td>
                <td>{{ $todo->status }}</td>
                <td>{{ $todo->priority }}</td>
            </tr>
        @endforeach
        <tr></tr>
        <tr></tr>
        <tr>
            <td colspan="3"><strong>Total Todos</strong></td>
            <td>{{ $summary['total'] }}</td>
        </tr>
        <tr>
            <td colspan="3"><strong>Total Time Tracked</strong></td>
            <td>{{ $summary['total_time'] }}</td>
        </tr>
    </tbody>
</table>
