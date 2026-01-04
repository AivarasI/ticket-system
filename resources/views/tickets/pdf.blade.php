<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Tickets Report</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 5px; text-align: left; }
        th { background-color: #eee; }
    </style>
</head>
<body>
    <h2>Tickets Report</h2>
    <table>
        <thead>
            <tr>
                <th>Title</th>
                <th>User</th>
                <th>Category</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($tickets as $ticket)
                <tr>
                    <td>{{ $ticket->title }}</td>
                    <td>{{ $ticket->user->name ?? '-' }}</td>
                    <td>{{ $ticket->category->name ?? '-' }}</td>
                    <td>{{ ucfirst(str_replace('_', ' ', $ticket->status)) }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">No tickets found</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>