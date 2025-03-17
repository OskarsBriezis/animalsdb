<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            All Users' Animals
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto py-6">
        <h1 class="text-2xl font-bold mb-4">All Users' Animals</h1>

        <table class="min-w-full border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border border-gray-300 px-4 py-2">Owner</th>
                    <th class="border border-gray-300 px-4 py-2">Name</th>
                    <th class="border border-gray-300 px-4 py-2">Species</th>
                    <th class="border border-gray-300 px-4 py-2">Age</th>
                    <th class="border border-gray-300 px-4 py-2">Image</th>
                    <th class="border border-gray-300 px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($animals as $animal)
                    <tr class="bg-white">
                        <td class="border border-gray-300 px-4 py-2">
                            {{ $animal->user ? $animal->user->name : 'Unknown' }}
                        </td>
                        <td class="border border-gray-300 px-4 py-2">{{ $animal->name }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $animal->species }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $animal->age }}</td>
                        <td class="border border-gray-300 px-4 py-2">
                            @if ($animal->image)
                                <img src="{{ asset('storage/' . $animal->image) }}" alt="Animal Image" class="w-16 h-16 object-cover rounded-lg">
                            @else
                                <span class="text-gray-500">No Image</span>
                            @endif
                        </td>
                        <td class="border border-gray-300 px-4 py-2">
                            <!-- Edit Button -->
                            <a href="{{ route('animals.edit', $animal->id) }}" class="bg-yellow-500 text-white px-3 py-1 rounded">
                                Edit
                            </a>

                            <!-- Delete Form -->
                            <form action="{{ route('animals.destroy', $animal->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Are you sure you want to delete this animal?')" class="bg-red-500 text-white px-3 py-1 rounded">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
