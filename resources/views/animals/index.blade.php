<x-app-layout>
    <x-slot name="header">
        <div class="text-5xl text-center animate-float mt-4">🐾</div>
        <h2 class="font-semibold text-xl text-white leading-tight animate-fade-in-down">
            My Animals
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 bg-[#C19A6B] p-6 rounded-md shadow-lg">
        <h3 class="text-2xl font-bold text-white mb-6">My Animals</h3>

        <form action="{{ route('animals.index') }}" method="GET" class="flex flex-col sm:flex-row sm:items-center gap-2 mb-6">
    <div class="flex gap-2 w-full sm:w-auto animate-slide-in-left">
        <!-- Filter Dropdown -->
        <select name="filter" class="px-3 py-2 rounded-md bg-[#F5F1E0] text-brown border border-gray-300">
            <option value="name" {{ request('filter') === 'name' ? 'selected' : '' }}>Name</option>
            <option value="species" {{ request('filter') === 'species' ? 'selected' : '' }}>Species</option>
            <option value="age" {{ request('filter') === 'age' ? 'selected' : '' }}>Age</option>
        </select>

        <!-- Search Input -->
        <input type="text" name="search" value="{{ request('search') }}"
            placeholder="Enter search..." 
            class="w-full sm:w-64 px-4 py-2 rounded-md bg-[#F5F1E0] text-brown border border-gray-300 focus:outline-none focus:ring-2 focus:ring-[#A67C4E]">

        <!-- Sort Dropdown (auto-submits) -->
        <select name="sort" onchange="this.form.submit()"
            class="px-3 py-2 rounded-md bg-[#F5F1E0] text-brown border border-gray-300">
            <option value="">Sort</option>
            <option value="asc" {{ request('sort') === 'asc' ? 'selected' : '' }}>A - Z</option>
            <option value="desc" {{ request('sort') === 'desc' ? 'selected' : '' }}>Z - A</option>
        </select>
    </div>

    <!-- Manual Search Button -->
    <div class="flex gap-2 animate-slide-in-right">
        <button type="submit"
            class="bg-[#A67C4E] text-white px-4 py-2 rounded-md hover:bg-[#8C6239] transition transform hover:scale-105 hover:shadow-lg duration-200">
        Search
        </button>

        @if(request('search') || request('sort'))
        <a href="{{ route('animals.index') }}" 
            class="text-sm text-white bg-red-400 px-3 py-2 rounded hover:bg-red-500 transition">
            Clear
        </a>
        @endif
    </div>
</form>


        <!-- Desktop Table View -->
        <div class="hidden md:block overflow-x-auto">
            <table class="min-w-full border-collapse border border-gray-300 bg-[#F5F1E0] text-sm sm:text-base">
                <thead>
                    <tr class="bg-[#C19A6B] text-white">
                        <th class="border border-gray-300 px-4 py-2">Name</th>
                        <th class="border border-gray-300 px-4 py-2">Species</th>
                        <th class="border border-gray-300 px-4 py-2">Age</th>
                        <th class="border border-gray-300 px-4 py-2">Image</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($animals as $animal)
                        @if ($animal->user_id === auth()->id())
                            <tr class="bg-[#F5F1E0]">
                                <td class="border border-gray-300 px-4 py-2 text-brown">{{ $animal->name }}</td>
                                <td class="border border-gray-300 px-4 py-2 text-brown">{{ $animal->species }}</td>
                                <td class="border border-gray-300 px-4 py-2 text-brown">{{ $animal->age }}</td>
                                <td class="border border-gray-300 px-4 py-2">
                                    @if ($animal->image)
                                        <img src="{{ asset('storage/' . $animal->image) }}" alt="Animal Image" class="w-16 h-16 object-cover rounded-lg">
                                    @else
                                        <span class="text-gray-500">No Image</span>
                                    @endif
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Mobile Card View -->
        <div class="md:hidden space-y-4">
            @foreach($animals as $animal)
                @if ($animal->user_id === auth()->id())
                    <div class="bg-[#F5F1E0] p-4 rounded-lg shadow-md">
                        <p class="text-brown font-bold">Name: <span class="font-normal">{{ $animal->name }}</span></p>
                        <p class="text-brown font-bold">Species: <span class="font-normal">{{ $animal->species }}</span></p>
                        <p class="text-brown font-bold">Age: <span class="font-normal">{{ $animal->age }}</span></p>

                        <div class="mt-2">
                            @if ($animal->image)
                                <img src="{{ asset('storage/' . $animal->image) }}" alt="Animal Image" class="w-24 h-24 object-cover rounded-lg shadow-sm">
                            @else
                                <p class="text-gray-500">No Image</p>
                            @endif
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</x-app-layout>
