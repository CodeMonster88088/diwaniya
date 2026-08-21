<x-app-layout>

    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Audio Management') }}
            </h2>

            <a href="{{ route('admin.audio.create') }}"
                class="px-4 py-2 bg-gray-800 text-white rounded-md hover:bg-gray-700">
                Add Audio
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-6 bg-green-100 border border-green-200 text-green-800 px-4 py-3 rounded-md">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white shadow-sm sm:rounded-lg overflow-hidden">

                <div class="p-6">

                    @if ($audioRecordings->count())

                        <div class="overflow-x-auto">
                            <table class="w-full text-left">
                                <thead>
                                    <tr class="border-b">
                                        <th class="px-4 py-3 text-sm font-semibold text-gray-600">
                                            Title
                                        </th>

                                        <th class="px-4 py-3 text-sm font-semibold text-gray-600">
                                            Speaker
                                        </th>

                                        <th class="px-4 py-3 text-sm font-semibold text-gray-600">
                                            Recorded
                                        </th>

                                        <th class="px-4 py-3 text-sm font-semibold text-gray-600">
                                            File
                                        </th>

                                        <th class="px-4 py-3 text-sm font-semibold text-gray-600">
                                            Status
                                        </th>
                                        <th class="px-4 py-3 text-sm font-semibold text-gray-600">
                                            Actions
                                        </th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($audioRecordings as $audio)
                                        <tr class="border-b last:border-b-0">

                                            <td class="px-4 py-4">
                                                <div class="font-medium text-gray-900">
                                                    {{ $audio->title }}
                                                </div>

                                                @if ($audio->category)
                                                    <div class="text-sm text-gray-500">
                                                        {{ $audio->category->name }}
                                                    </div>
                                                @endif
                                            </td>

                                            <td class="px-4 py-4 text-gray-700">
                                                {{ $audio->speaker ?: '—' }}
                                            </td>

                                            <td class="px-4 py-4 text-gray-700">
                                                {{ $audio->recorded_at?->format('Y-m-d') ?: '—' }}
                                            </td>

                                            <td class="px-4 py-4">
                                                <audio controls class="w-64">
                                                    <source src="{{ asset('storage/audio/' . $audio->filename) }}"
                                                        type="{{ $audio->mime_type }}">
                                                    Your browser does not support the audio player.
                                                </audio>
                                            </td>

                                            <td class="px-4 py-4">
                                                @if ($audio->is_published)
                                                    <span class="text-green-700">
                                                        Published
                                                    </span>
                                                @else
                                                    <span class="text-gray-500">
                                                        Draft
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="px-4 py-4">
                                                <div class="flex items-center gap-3">

                                                    <a href="{{ route('admin.audio.edit', $audio) }}"
                                                        class="text-blue-600 hover:text-blue-800">
                                                        Edit
                                                    </a>

                                                    <form method="POST" action="{{ route('admin.audio.destroy', $audio) }}"
                                                        onsubmit="return confirm('Are you sure you want to delete this recording?');">
                                                        @csrf
                                                        @method('DELETE')

                                                        <button type="submit" class="text-red-600 hover:text-red-800">
                                                            Delete
                                                        </button>
                                                    </form>

                                                </div>
                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-6">
                            {{ $audioRecordings->links() }}
                        </div>

                    @else

                        <div class="text-center py-12">
                            <p class="text-gray-500">
                                No audio recordings have been added yet.
                            </p>

                            <a href="{{ route('admin.audio.create') }}"
                                class="inline-block mt-4 px-4 py-2 bg-gray-800 text-white rounded-md">
                                Add Your First Recording
                            </a>
                        </div>

                    @endif

                </div>
            </div>

        </div>
    </div>

</x-app-layout>