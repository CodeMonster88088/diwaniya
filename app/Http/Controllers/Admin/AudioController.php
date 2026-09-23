<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AudioRecording;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;
use App\Models\Category;

class AudioController extends Controller
{
    public function index(): View
    {
        $audioRecordings = AudioRecording::with('category')
            ->latest()
            ->paginate(10);

        $audioRecordings->getCollection()->each(function ($audio) {
            $audio->storage_url = app()->environment('production')
                ? Storage::temporaryUrl(
                    'audio/' . $audio->filename,
                    now()->addHour()
                )
                : asset('storage/audio/' . $audio->filename);
        });

        return view('admin.audio.index', compact('audioRecordings'));
    }

    public function create(): View
    {
        $categories = Category::where('type', 'audio')
            ->orderBy('name')
            ->get();

        return view('admin.audio.create', compact('categories'));
    }
    public function edit(AudioRecording $audioRecording): View
    {
        $categories = Category::where('type', 'audio')
            ->orderBy('name')
            ->get();

        $audioRecording->storage_url = app()->environment('production')
            ? Storage::temporaryUrl(
                'audio/' . $audioRecording->filename,
                now()->addHour()
            )
            : asset('storage/audio/' . $audioRecording->filename);

        return view('admin.audio.edit', compact('audioRecording', 'categories'));
    }

    public function update(Request $request, AudioRecording $audioRecording): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'speaker' => ['nullable', 'string', 'max:255'],
            'recorded_at' => ['nullable', 'date'],
            'location' => ['nullable', 'string', 'max:255'],
            'transcript' => ['nullable', 'string'],
            'category_id' => ['nullable', 'exists:categories,id'],
            'is_published' => ['boolean'],
            'audio_file' => [
                'nullable',
                'file',
                'mimes:mp3,wav,m4a,ogg,aac',
                'max:204800',
            ],
        ]);

        $data = [
            'title' => $validated['title'],
            'slug' => Str::slug($validated['title']) . '-' . Str::random(6),
            'description' => $validated['description'] ?? null,
            'speaker' => $validated['speaker'] ?? null,
            'recorded_at' => $validated['recorded_at'] ?? null,
            'location' => $validated['location'] ?? null,
            'category_id' => $validated['category_id'] ?? null,
            'transcript' => $validated['transcript'] ?? null,
            'is_published' => $request->boolean('is_published'),
        ];

        if ($request->hasFile('audio_file')) {
            $oldFilename = $audioRecording->filename;

            $file = $request->file('audio_file');
            $newFilename = $file->hashName();

            $file->storeAs('audio', $newFilename);

            $data['filename'] = $newFilename;
            $data['original_filename'] = $file->getClientOriginalName();
            $data['mime_type'] = $file->getMimeType();
            $data['file_size'] = $file->getSize();

            if ($oldFilename) {
                Storage::delete('audio/' . $oldFilename);
            }
        }

        $audioRecording->update($data);

        return redirect()
            ->route('admin.audio.index')
            ->with('success', 'Audio recording updated successfully.');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'speaker' => ['nullable', 'string', 'max:255'],
            'recorded_at' => ['nullable', 'date'],
            'category_id' => ['nullable', 'exists:categories,id'],
            'location' => ['nullable', 'string', 'max:255'],
            'transcript' => ['nullable', 'string'],
            'audio_file' => [
                'required',
                'file',
                'mimes:mp3,wav,m4a,ogg,aac',
                'max:204800',
            ],
        ]);

        $file = $request->file('audio_file');

        $filename = $file->hashName();

        $file->storeAs('audio', $filename);

        AudioRecording::create([
            'title' => $validated['title'],
            'slug' => Str::slug($validated['title']) . '-' . Str::random(6),
            'description' => $validated['description'] ?? null,
            'speaker' => $validated['speaker'] ?? null,
            'recorded_at' => $validated['recorded_at'] ?? null,
            'location' => $validated['location'] ?? null,
            'filename' => $filename,
            'category_id' => $validated['category_id'] ?? null,
            'original_filename' => $file->getClientOriginalName(),
            'mime_type' => $file->getMimeType(),
            'file_size' => $file->getSize(),
            'transcript' => $validated['transcript'] ?? null,
            'is_published' => true,
        ]);

        return redirect()
            ->route('admin.audio.index')
            ->with('success', 'Audio recording uploaded successfully.');
    }
    public function destroy(AudioRecording $audioRecording): RedirectResponse
    {
        if ($audioRecording->filename) {
            Storage::delete('audio/' . $audioRecording->filename);
        }

        $audioRecording->delete();

        return redirect()
            ->route('admin.audio.index')
            ->with('success', 'Audio recording deleted successfully.');
    }
}