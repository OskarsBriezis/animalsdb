<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            My Animals
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 bg-[#C19A6B] p-6 rounded-md shadow-lg">
        <h3 class="text-2xl font-bold text-white mb-6">My Animals</h3>

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
