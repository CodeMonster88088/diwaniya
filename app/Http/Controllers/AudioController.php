<?php

namespace App\Http\Controllers;

use App\Models\AudioRecording;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class AudioController extends Controller
{
    public function index(): View
    {
        $audioRecordings = AudioRecording::with('category')
            ->where('is_published', true)
            ->latest('recorded_at')
            ->paginate(12);

        $audioRecordings->getCollection()->each(function ($audio) {
            $audio->storage_url = Storage::temporaryUrl(
                'audio/' . $audio->filename,
                now()->addHour()
            );
        });

        return view('audio.index', compact('audioRecordings'));
    }
}