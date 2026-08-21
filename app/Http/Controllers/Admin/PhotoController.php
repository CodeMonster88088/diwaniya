<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\HistoricalPhoto;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;

class PhotoController extends Controller
{
    public function index(): View
    {
        $photos = HistoricalPhoto::with('category')
            ->latest()
            ->paginate(12);

        return view('admin.photos.index', compact('photos'));
    }

    public function create(): View
    {
        $categories = Category::where('type', 'photo')
            ->orderBy('name')
            ->get();

        return view('admin.photos.create', compact('categories'));
    }
    public function edit(HistoricalPhoto $photo): View
    {
        $categories = Category::where('type', 'photo')
            ->orderBy('name')
            ->get();

        return view('admin.photos.edit', compact('photo', 'categories'));
    }

    public function update(Request $request, HistoricalPhoto $photo): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'category_id' => ['nullable', 'exists:categories,id'],
            'description' => ['nullable', 'string'],
            'photographed_at' => ['nullable', 'date'],
            'location' => ['nullable', 'string', 'max:255'],
            'people' => ['nullable', 'string'],
            'photographer' => ['nullable', 'string', 'max:255'],
            'is_published' => ['boolean'],
            'photo' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:20480',
            ],
        ]);

        $data = [
            'category_id' => $validated['category_id'] ?? null,
            'title' => $validated['title'],
            'slug' => Str::slug($validated['title']) . '-' . Str::random(6),
            'description' => $validated['description'] ?? null,
            'photographed_at' => $validated['photographed_at'] ?? null,
            'location' => $validated['location'] ?? null,
            'people' => $validated['people'] ?? null,
            'photographer' => $validated['photographer'] ?? null,
            'is_published' => $request->boolean('is_published'),
        ];

        if ($request->hasFile('photo')) {
            $oldFilename = $photo->filename;

            $file = $request->file('photo');
            $newFilename = $file->hashName();

            $file->storeAs('photos', $newFilename, 'public');

            $data['filename'] = $newFilename;
            $data['original_filename'] = $file->getClientOriginalName();

            if ($oldFilename) {
                Storage::disk('public')->delete('photos/' . $oldFilename);
            }
        }

        $photo->update($data);

        return redirect()
            ->route('admin.photos.index')
            ->with('success', 'Photo updated successfully.');
    }
    public function destroy(HistoricalPhoto $photo): RedirectResponse
    {
        if ($photo->filename) {
            Storage::disk('public')->delete('photos/' . $photo->filename);
        }

        $photo->delete();

        return redirect()
            ->route('admin.photos.index')
            ->with('success', 'Photo deleted successfully.');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'category_id' => ['nullable', 'exists:categories,id'],
            'description' => ['nullable', 'string'],
            'photographed_at' => ['nullable', 'date'],
            'location' => ['nullable', 'string', 'max:255'],
            'people' => ['nullable', 'string'],
            'photographer' => ['nullable', 'string', 'max:255'],
            'photo' => [
                'required',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:20480',
            ],
        ]);

        $file = $request->file('photo');
        $filename = $file->hashName();

        $file->storeAs('photos', $filename, 'public');

        HistoricalPhoto::create([
            'category_id' => $validated['category_id'] ?? null,
            'title' => $validated['title'],
            'slug' => Str::slug($validated['title']) . '-' . Str::random(6),
            'description' => $validated['description'] ?? null,
            'filename' => $filename,
            'original_filename' => $file->getClientOriginalName(),
            'photographed_at' => $validated['photographed_at'] ?? null,
            'location' => $validated['location'] ?? null,
            'people' => $validated['people'] ?? null,
            'photographer' => $validated['photographer'] ?? null,
            'is_published' => true,
        ]);

        return redirect()
            ->route('admin.photos.index')
            ->with('success', 'Photo uploaded successfully.');
    }
}