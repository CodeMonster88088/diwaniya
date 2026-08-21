<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AudioRecording;
use App\Models\HistoricalPhoto;
use App\Models\Poem;
use App\Models\Event;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'audio' => AudioRecording::count(),
            'photos' => HistoricalPhoto::count(),
            'poems' => Poem::count(),
            'events' => Event::count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}