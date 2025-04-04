<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            Admin Panel: Manage Animals
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto py-6 bg-[#C19A6B] p-6 rounded-md shadow-lg">
        <h3 class="text-2xl font-bold text-white mb-6">Animals List</h3>

        <!-- Table to display animals -->
        <table class="min-w-full table-auto border-collapse border border-gray-300">
            <thead>
                <tr class="bg-[#C19A6B]">
                    <th class="border border-gray-300 px-4 py-2 text-white">Name</th>
                    <th class="border border-gray-300 px-4 py-2 text-white">Species</th>
                    <th class="border border-gray-300 px-4 py-2 text-white">Age</th>
                    <th class="border border-gray-300 px-4 py-2 text-white">Image</th>
                    <th class="border border-gray-300 px-4 py-2 text-white">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($animals as $animal)
                    <tr class="bg-[#F5F1E0]">
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
                            <a href="{{ route('animals.show', $animal->id) }}" class="bg-[#A67C4E] text-white px-4 py-2 rounded-md hover:bg-[#C19A6B]">View Info</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
