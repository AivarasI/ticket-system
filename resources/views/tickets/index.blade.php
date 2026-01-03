<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">My Tickets</h2>
    </x-slot>

    <div class="p-6">
        <a href="{{ route('tickets.create') }}" class="btn btn-primary">
            Create Ticket
        </a>

        <table class="mt-4 w-full">
            <tr>
                <th>Title</th>
                <th>Category</th>
                <th>Status</th>
            </tr>

            @foreach($tickets as $ticket)
                <tr>
                    <td>{{ $ticket->title }}</td>
                    <td>{{ $ticket->category->name }}</td>
                    <td>{{ $ticket->status }}</td>
                </tr>
            @endforeach
        </table>
    </div>
</x-app-layout>