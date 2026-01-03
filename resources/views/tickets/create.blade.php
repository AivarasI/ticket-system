<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">Create Ticket</h2>
    </x-slot>

    <div class="p-6">
        <form method="POST" action="{{ route('tickets.store') }}">
            @csrf

            <div>
                <label>Title</label>
                <input type="text" name="title" required class="border w-full">
            </div>

            <div class="mt-4">
                <label>Description</label>
                <textarea name="description" required class="border w-full"></textarea>
            </div>

            <div class="mt-4">
                <label>Category</label>
                <select name="category_id" required class="border w-full">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button class="mt-4 bg-blue-500 text-black px-4 py-2">
                Save
            </button>
        </form>
    </div>
</x-app-layout>