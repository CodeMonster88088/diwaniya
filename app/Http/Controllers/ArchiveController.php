<?php

namespace App\Http\Controllers;

use App\Models\HistoricalPhoto;
use App\Models\Poem;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ArchiveController extends Controller
{
    public function index(): View
    {
        $photos = HistoricalPhoto::with('category')
            ->where('is_published', true)
            ->latest('photographed_at')
            ->take(8)
            ->get();

        $photos->each(function ($photo) {
            $photo->storage_url = Storage::temporaryUrl(
                'photos/' . $photo->filename,
                now()->addHour()
            );
        });

        $poems = Poem::with('category')
            ->where('is_published', true)
            ->latest('written_at')
            ->take(8)
            ->get();

        return view('archive.index', compact('photos', 'poems'));
    }

    public function showPoem(Poem $poem): View
    {
        if (! $poem->is_published) {
            abort(404);
        }

        $poem->load('category');

        return view('archive.poem', compact('poem'));
    }
}