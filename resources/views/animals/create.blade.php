<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Create a New Animal
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto py-6">
        <form action="{{ route('animals.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Name Field -->
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Name (max 20 characters, no numbers)</label>
                <input type="text" name="name" value="{{ old('name') }}" class="border border-gray-300 rounded-md w-full p-2">
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>


            <!-- Species Field -->
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Species</label>
                <input type="text" name="species" value="{{ old('species') }}" class="border border-gray-300 rounded-md w-full p-2">
                @error('species')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Age Field -->
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Age</label>
                <input type="number" name="age" value="{{ old('age') }}" class="border border-gray-300 rounded-md w-full p-2">
                @error('age')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Image Upload -->
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Upload Image (Optional, max 2MB)</label>
                <input type="file" name="image" class="border border-gray-300 rounded-md w-full p-2">
                @error('image')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md">Create Animal</button>
        </form>
    </div>
</x-app-layout>
