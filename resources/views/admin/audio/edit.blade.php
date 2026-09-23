<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Audio Recording') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-6">

                    <form method="POST"
      action="{{ route('admin.audio.update', $audioRecording) }}"
      enctype="multipart/form-data"
      class="space-y-6">

                        @csrf
                        @method('PUT')

                        <div>
                            <x-input-label for="title" :value="__('Title')" />

                            <x-text-input
                                id="title"
                                name="title"
                                type="text"
                                class="mt-1 block w-full"
                                value="{{ old('title', $audioRecording->title) }}"
                                required
                            />

                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>
                        <!-- Category -->
                        <div>
    <x-input-label for="category_id" :value="__('Category')" />

    <select
        id="category_id"
        name="category_id"
        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
    >
        <option value="">No category</option>

        @foreach ($categories as $category)
            <option
                value="{{ $category->id }}"
                @selected(old('category_id', $audioRecording->category_id) == $category->id)
            >
                {{ $category->name }}
            </option>
        @endforeach
    </select>

    <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
</div>
                        <div>
                            <x-input-label for="description" :value="__('Description')" />

                            <textarea
                                id="description"
                                name="description"
                                rows="4"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                            >{{ old('description', $audioRecording->description) }}</textarea>

                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="speaker" :value="__('Speaker')" />

                            <x-text-input
                                id="speaker"
                                name="speaker"
                                type="text"
                                class="mt-1 block w-full"
                                value="{{ old('speaker', $audioRecording->speaker) }}"
                            />

                            <x-input-error :messages="$errors->get('speaker')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="recorded_at" :value="__('Recorded Date')" />

                            <x-text-input
                                id="recorded_at"
                                name="recorded_at"
                                type="date"
                                class="mt-1 block w-full"
                                value="{{ old('recorded_at', $audioRecording->recorded_at?->format('Y-m-d')) }}"
                            />

                            <x-input-error :messages="$errors->get('recorded_at')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="location" :value="__('Location')" />

                            <x-text-input
                                id="location"
                                name="location"
                                type="text"
                                class="mt-1 block w-full"
                                value="{{ old('location', $audioRecording->location) }}"
                            />

                            <x-input-error :messages="$errors->get('location')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="transcript" :value="__('Transcript')" />

                            <textarea
                                id="transcript"
                                name="transcript"
                                rows="8"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                            >{{ old('transcript', $audioRecording->transcript) }}</textarea>

                            <x-input-error :messages="$errors->get('transcript')" class="mt-2" />
                        </div>
                        <div>
    <x-input-label for="audio_file" :value="__('Replace Audio File')" />

    <div class="mt-2">
        <audio controls class="w-full max-w-xl">
            <source
                src="{{ $audio->storage_url }}"
                type="{{ $audioRecording->mime_type }}"
            >
            Your browser does not support the audio player.
        </audio>
    </div>

    <input
        id="audio_file"
        name="audio_file"
        type="file"
        accept=".mp3,.wav,.m4a,.ogg,.aac"
        class="mt-3 block w-full text-sm text-gray-700"
    >

    <p class="mt-1 text-sm text-gray-500">
        Leave empty to keep the current audio file.
    </p>

    <x-input-error :messages="$errors->get('audio_file')" class="mt-2" />
</div>
                        <div class="flex items-center gap-3">
                            <input
                                id="is_published"
                                name="is_published"
                                type="checkbox"
                                value="1"
                                class="rounded border-gray-300"
                                @checked(old('is_published', $audioRecording->is_published))
                            >

                            <x-input-label
                                for="is_published"
                                :value="__('Published')"
                            />
                        </div>

                        <div class="flex items-center gap-4">
                            <a
                                href="{{ route('admin.audio.index') }}"
                                class="px-4 py-2 bg-gray-200 rounded-md"
                            >
                                Cancel
                            </a>

                            <button
                                type="submit"
                                class="px-4 py-2 bg-gray-800 text-white rounded-md hover:bg-gray-700"
                            >
                                Save Changes
                            </button>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>

</x-app-layout>