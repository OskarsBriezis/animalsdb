<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            Animal Info: {{ $animal->name }}
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto py-6 px-4 sm:px-6 bg-[#C19A6B] p-6 rounded-md shadow-lg">
        <div class="bg-[#F5F1E0] p-6 rounded-md shadow-md">
            <h3 class="text-2xl font-bold text-brown mb-4">Animal Details</h3>

            <div class="mb-4">
                <span class="font-semibold text-brown">Name:</span>
                <p class="text-gray-700">{{ $animal->name }}</p>
            </div>

            <div class="mb-4">
                <span class="font-semibold text-brown">Species:</span>
                <p class="text-gray-700">{{ $animal->species }}</p>
            </div>

            <div class="mb-4">
                <span class="font-semibold text-brown">Age:</span>
                <p class="text-gray-700">{{ $animal->age }} years</p>
            </div>

            <div class="mb-4">
                <span class="font-semibold text-brown">Image:</span>
                <div class="mt-2">
                    @if ($animal->image)
                        <img src="{{ asset('storage/' . $animal->image) }}" alt="Animal Image" class="w-48 h-48 object-cover rounded-lg shadow-md">
                    @else
                        <span class="text-gray-500">No Image Available</span>
                    @endif
                </div>
            </div>

            <div class="mt-6 flex flex-col sm:flex-row justify-end space-y-2 sm:space-y-0 sm:space-x-4">
                <a href="{{ route('animals.edit', $animal->id) }}" class="bg-[#A67C4E] text-white px-4 py-2 rounded-md hover:bg-[#C19A6B] text-center">Edit</a>

                <form action="{{ route('animals.destroy', $animal->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this animal?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700 w-full sm:w-auto">Delete</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>