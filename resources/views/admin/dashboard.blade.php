<x-app-layout>

```
<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Admin Dashboard') }}
    </h2>
</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        <!-- Admin Navigation Tabs -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
            <div class="border-b border-gray-200">
                <nav class="flex flex-wrap" aria-label="Admin Navigation">

                    <!-- Dashboard -->
                    <a href="{{ route('admin.dashboard') }}"
                       class="px-6 py-4 text-sm font-medium text-gray-900 border-b-2 border-gray-900">
                        Dashboard
                    </a>

                    <!-- Audios -->
                    <a href="{{ route('admin.audio.index') }}"
                       class="px-6 py-4 text-sm font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-50">
                        Audios
                    </a>

                    <!-- Photos -->
                    <a href="{{ route('admin.photos.index') }}"
                       class="px-6 py-4 text-sm font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-50">
                        Photos
                    </a>

                    <!-- Poems -->
                    <a href="{{ route('admin.poems.index') }}"
                       class="px-6 py-4 text-sm font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-50">
                        Poems
                    </a>

                </nav>
            </div>
        </div>

        <!-- Statistics -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

            <!-- Audio -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <p class="text-gray-500 text-sm">Audio Recordings</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2">
                        {{ $stats['audio'] }}
                    </p>
                </div>
            </div>

            <!-- Photos -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <p class="text-gray-500 text-sm">Historical Photos</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2">
                        {{ $stats['photos'] }}
                    </p>
                </div>
            </div>

            <!-- Poems -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <p class="text-gray-500 text-sm">Poems</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2">
                        {{ $stats['poems'] }}
                    </p>
                </div>
            </div>

            <!-- Events -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <p class="text-gray-500 text-sm">Events</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2">
                        {{ $stats['events'] }}
                    </p>
                </div>
            </div>

        </div>

    </div>
</div>
```

</x-app-layout>
