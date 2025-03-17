<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Animal
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto py-6">
        <form action="{{ route('animals.update', $animal->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Name:</label>
                <input type="text" name="name" value="{{ old('name', $animal->name) }}" class="w-full border px-3 py-2">
                @error('name') <p class="text-red-500">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Species:</label>
                <input type="text" name="species" value="{{ old('species', $animal->species) }}" class="w-full border px-3 py-2">
                @error('species') <p class="text-red-500">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Age:</label>
                <input type="number" name="age" value="{{ old('age', $animal->age) }}" class="w-full border px-3 py-2">
                @error('age') <p class="text-red-500">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Current Image:</label>
                @if($animal->image)
                    <img src="{{ asset('storage/' . $animal->image) }}" class="w-32 h-32 object-cover mb-2">
                @endif
                <input type="file" name="image" class="w-full border px-3 py-2">
                @error('image') <p class="text-red-500">{{ $message }}</p> @enderror
            </div>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update</button>
        </form>
    </div>
</x-app-layout>
