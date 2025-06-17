<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            Create a New Animal
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <div class="bg-[#C19A6B] p-6 sm:p-8 rounded-md shadow-lg">
            <form action="{{ route('animals.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Name Field -->
                <div class="mb-4">
                    <label class="block text-white font-bold mb-2">Name (max 20 characters, no numbers)</label>
                    <input
                        type="text"
                        name="name"
                        value="{{ old('name') }}"
                        class="w-full p-2 rounded-md bg-[#F5F1E0] border border-gray-300 focus:outline-none focus:ring-2 focus:ring-[#A67C4E]"
                        maxlength="20"
                        pattern="[A-Za-z\s]+"
                        required
                    >
                    @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Species Field -->
                <div class="mb-4">
                    <label class="block text-white font-bold mb-2">Species</label>
                    <input
                        type="text"
                        name="species"
                        value="{{ old('species') }}"
                        class="w-full p-2 rounded-md bg-[#F5F1E0] border border-gray-300 focus:outline-none focus:ring-2 focus:ring-[#A67C4E]"
                        required
                    >
                    @error('species')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Age Field -->
                <div class="mb-4">
                    <label class="block text-white font-bold mb-2">Age</label>
                    <input
                        type="number"
                        name="age"
                        value="{{ old('age') }}"
                        class="w-full p-2 rounded-md bg-[#F5F1E0] border border-gray-300 focus:outline-none focus:ring-2 focus:ring-[#A67C4E]"
                        required
                    >
                    @error('age')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Image Upload -->
                <div class="mb-6">
                    <label class="block text-white font-bold mb-2">Upload Image (Optional, max 2MB)</label>
                    <input
                        type="file"
                        name="image"
                        class="w-full p-2 bg-white text-gray-800 border border-gray-300 rounded-md file:bg-[#F5F1E0] file:text-black file:border-0 file:mr-4 file:py-2 file:px-4 file:rounded-md"
                    >
                    @error('image')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <button
                    type="submit"
                    class="w-full sm:w-auto bg-[#A67C4E] text-white px-6 py-2 rounded-md hover:bg-[#C19A6B] transition duration-200"
                >
                    Create Animal
                </button>
            </form>
        </div>
    </div>
</x-app-layout>
