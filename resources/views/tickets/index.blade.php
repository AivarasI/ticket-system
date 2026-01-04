<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">My Tickets</h2>
    </x-slot>

    <div class="p-6">
        <a href="{{ route('tickets.create') }}" class="btn btn-primary">
            Create Ticket
        </a>
        <a href="{{ route('tickets.pdf') }}" class="mt-4 inline-block bg-black text-black px-4 py-2">
            Download PDF Report
        </a>

        <table class="mt-4 w-full border-collapse border border-gray-300">
    <thead>
        <tr class="bg-gray-100">
            <th class="border px-2 py-1 w-1/4">Title</th>
            <th class="border px-2 py-1 w-1/4">Category</th>
            <th class="border px-2 py-1 w-1/4">Status</th>
            <th class="border px-2 py-1 w-1/4">Edit</th>
        </tr>
    </thead>
    <tbody>
        @foreach($tickets as $ticket)
            <tr>
                <td class="border px-2 py-1">{{ $ticket->title }}</td>
                <td class="border px-2 py-1">{{ $ticket->category->name ?? '-' }}</td>
                <td class="border px-2 py-1">{{ ucfirst(str_replace('_', ' ', $ticket->status)) }}</td>
                <td class="border px-2 py-1">
                    <a href="{{ route('tickets.edit', $ticket->id) }}" class="text-blue-500">Edit</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
        
        
    </div>
</x-app-layout>