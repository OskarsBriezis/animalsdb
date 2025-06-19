<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log; // Add this to the top of AnimalController.php


class AnimalController extends Controller
{
    // Show the form for creating a new animal
    public function create()
    {
        return view('animals.create'); // This will return a form view
    }

    // Store a new animal in the database
    public function store(Request $request)
{
    $request->validate([
        'name' => ['required', 'string', 'max:20', 'regex:/^[a-zA-Z\s]+$/'], // No numbers allowed
        'species' => ['required', 'string', 'max:50', 'regex:/^[a-zA-Z\s]+$/'], // No numbers allowed, max 50 characters
        'age' => 'required|integer|min:0|max:100',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
    ]);

    $imagePath = null;
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('animal_images', 'public');
    }

    Animal::create([
        'name' => $request->name,
        'species' => $request->species,
        'age' => $request->age,
        'image' => $imagePath,
        'user_id' => auth()->id(),
    ]);

    return redirect()->route('animals.index')->with('success', 'Animal created successfully!');
}

public function index(Request $request)
{
    $query = Animal::query();

    // Filtered search
    if ($request->filled('search')) {
        $search = $request->input('search');
        $filter = $request->input('filter', 'name');

        if (in_array($filter, ['name', 'species', 'age'])) {
            $query->where($filter, 'like', "%{$search}%");
        }
    }

    // Sorting logic
    $sort = $request->input('sort');
    if (in_array($sort, ['asc', 'desc'])) {
        $query->orderBy('name', $sort); // Sorts by name
    } else {
        $query->latest(); // Default sort
    }

    $animals = $query->paginate(10)->withQueryString();

    return view('animals.index', compact('animals'));
}


public function destroy($id)
{
    if (auth()->user()->role !== 'admin') {
        abort(403, 'Unauthorized action.');
    }

    $animal = Animal::findOrFail($id);
    if ($animal->image) {
        Storage::delete('public/' . $animal->image);
    }

    $animal->delete();

    return redirect()->route('animals.index')->with('success', 'Animal deleted successfully!');
}


public function edit($id)
{
    if (auth()->user()->role !== 'admin') {
        abort(403, 'Unauthorized action.');
    }

    $animal = Animal::findOrFail($id);
    return view('animals.edit', compact('animal'));
}

public function show($id)
{
    $animal = Animal::findOrFail($id);
    return view('animals.view_info', compact('animal'));
}



public function update(Request $request, Animal $animal)
{
    Log::info('Update function called for animal ID: ' . $animal->id); // Log to see if function runs

    // Validate input
    $validated = $request->validate([
        'name' => ['required', 'string', 'max:20', 'regex:/^[A-Za-z\s]+$/'],  // No numbers, max 20 characters
        'species' => ['required', 'string', 'max:50', 'regex:/^[a-zA-Z\s]+$/'], // No numbers allowed, max 50 characters
        'age' => ['required', 'integer', 'min:0'],  // Age must be an integer and at least 0
        'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],  // Optional image (max 2MB)
    ]);

    Log::info('Validated data: ', $validated); // Log validated data

    // Handle image update
    if ($request->hasFile('image')) {
        if ($animal->image) {
            Storage::delete($animal->image);
        }
        $validated['image'] = $request->file('image')->store('animal_images', 'public');
        Log::info('New image uploaded: ' . $validated['image']);
    }

    // Update database
    $updated = $animal->update($validated);

    if ($updated) {
        Log::info('Animal updated successfully in database.');
    } else {
        Log::error('Failed to update animal.');
    }

    return redirect()->route('animals.index')->with('success', 'Animal updated successfully!');
}




public function adminAnimals()
{
    if (auth()->user()->role !== 'admin') {
        abort(403, 'Unauthorized action.');
    }

    $animals = Animal::with('user')->get();
    return view('animals.admin_index', compact('animals'));
}

public function userAnimals(User $user)
{
    // Fetch all animals belonging to the selected user
    $animals = Animal::where('user_id', $user->id)->get();

    return view('users.animals', compact('user', 'animals'));
}

}

