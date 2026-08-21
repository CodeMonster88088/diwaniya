<?php

namespace App\Http\Controllers;

use App\Models\AudioRecording;
use Illuminate\View\View;

class AudioController extends Controller
{
    public function index(): View
    {
        $audioRecordings = AudioRecording::with('category')
            ->where('is_published', true)
            ->latest('recorded_at')
            ->paginate(12);

        return view('audio.index', compact('audioRecordings'));
    }
}