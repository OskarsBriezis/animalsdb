<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            My Animals
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto py-6 ">
        <table class="min-w-full border-collapse border border-gray-300 bg-[#F5F1E0]">
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
                    @if ($animal->user_id === auth()->id())  {{-- Only show current user's animals --}}
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
</x-app-layout>
