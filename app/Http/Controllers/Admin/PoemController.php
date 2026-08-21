<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Poem;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class PoemController extends Controller
{
    public function index(): View
    {
        $poems = Poem::with('category')
            ->latest()
            ->paginate(12);

        return view('admin.poems.index', compact('poems'));
    }

    public function create(): View
    {
        $categories = Category::where('type', 'poem')
            ->orderBy('name')
            ->get();

        return view('admin.poems.create', compact('categories'));
    }
    public function edit(Poem $poem): View
    {
        $categories = Category::where('type', 'poem')
            ->orderBy('name')
            ->get();

        return view('admin.poems.edit', compact('poem', 'categories'));
    }

    public function update(Request $request, Poem $poem): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'category_id' => ['nullable', 'exists:categories,id'],
            'poet' => ['nullable', 'string', 'max:255'],
            'content' => ['required', 'string'],
            'description' => ['nullable', 'string'],
            'written_at' => ['nullable', 'date'],
            'is_published' => ['boolean'],
        ]);

        $poem->update([
            'category_id' => $validated['category_id'] ?? null,
            'title' => $validated['title'],
            'slug' => Str::slug($validated['title']) . '-' . Str::random(6),
            'poet' => $validated['poet'] ?? null,
            'content' => $validated['content'],
            'description' => $validated['description'] ?? null,
            'written_at' => $validated['written_at'] ?? null,
            'is_published' => $request->boolean('is_published'),
        ]);

        return redirect()
            ->route('admin.poems.index')
            ->with('success', 'Poem updated successfully.');
    }
    public function destroy(Poem $poem): RedirectResponse
    {
        $poem->delete();

        return redirect()
            ->route('admin.poems.index')
            ->with('success', 'Poem deleted successfully.');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'category_id' => ['nullable', 'exists:categories,id'],
            'poet' => ['nullable', 'string', 'max:255'],
            'content' => ['required', 'string'],
            'description' => ['nullable', 'string'],
            'written_at' => ['nullable', 'date'],
        ]);

        Poem::create([
            'category_id' => $validated['category_id'] ?? null,
            'title' => $validated['title'],
            'slug' => Str::slug($validated['title']) . '-' . Str::random(6),
            'poet' => $validated['poet'] ?? null,
            'content' => $validated['content'],
            'description' => $validated['description'] ?? null,
            'written_at' => $validated['written_at'] ?? null,
            'is_published' => true,
        ]);

        return redirect()
            ->route('admin.poems.index')
            ->with('success', 'Poem created successfully.');
    }
}