<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">Edit Ticket</h2>
    </x-slot>

    <div class="p-6">
        <form method="POST" action="{{ route('tickets.update', $ticket->id) }}">
            @csrf
            @method('PUT')

            <div>
                <label>Title</label>
                <input type="text" name="title" value="{{ $ticket->title }}" required class="border w-full">
            </div>

            <div class="mt-4">
                <label>Description</label>
                <textarea name="description" required class="border w-full">{{ $ticket->description }}</textarea>
            </div>

            <div class="mt-4">
                <label>Category</label>
                <select name="category_id" required class="border w-full">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" @if($ticket->category_id == $category->id) selected @endif>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mt-4">
                <label>Status</label>
                <select name="status" required class="border w-full">
                    @foreach($statuses as $status)
                        <option value="{{ $status }}" @if($ticket->status == $status) selected @endif>
                            {{ ucfirst(str_replace('_', ' ', $status)) }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button class="mt-4 bg-blue-500 text-black px-4 py-2">
                Update
            </button>
        </form>

    <hr class="my-6">

    <!-- Komentarai -->
    <h3 class="font-semibold text-lg mb-2">Comments</h3>

    <ul class="mb-4">
        @foreach($ticket->comments as $comment)
            <li class="border p-2 mb-2 rounded">
                <strong>{{ $comment->user->name }}:</strong> {{ $comment->content }}
                <span class="text-gray-500 text-sm">({{ $comment->created_at->diffForHumans() }})</span>
            </li>
        @endforeach
    </ul>

    <form method="POST" action="{{ route('tickets.comments.store', $ticket->id) }}">
        @csrf
        <textarea name="content" class="border w-full p-2 mb-2" placeholder="Add a comment..." required></textarea>
        <button type="submit" class="px-4 py-2 bg-black text-black rounded hover:bg-gray-800">Add Comment</button>
    </form>

    </div>


    @if(auth()->user()->isAdmin())
    <div class="mt-4">
        <label>Status</label>
        <select name="status" class="border w-full">
            @foreach($statuses as $status)
                <option value="{{ $status }}"
                    @selected($ticket->status === $status)>
                    {{ ucfirst(str_replace('_', ' ', $status)) }}
                </option>
            @endforeach
        </select>
    </div>
@endif
   
</x-app-layout>