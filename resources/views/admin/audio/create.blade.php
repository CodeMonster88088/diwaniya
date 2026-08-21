<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add Audio Recording') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-6">

                    <form method="POST" action="{{ route('admin.audio.store') }}" enctype="multipart/form-data"
                        class="space-y-6">

                        @csrf

                        <div>
                            <x-input-label for="title" :value="__('Title')" />
                            <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" required />
                        </div>
                        <div>
                            <x-input-label for="category_id" :value="__('Category')" />

                            <select id="category_id" name="category_id"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                                <option value="">No category</option>

                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" @selected(old('category_id') == $category->id)>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>

                            <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="description" :value="__('Description')" />
                            <textarea id="description" name="description" rows="4"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"></textarea>
                        </div>

                        <div>
                            <x-input-label for="speaker" :value="__('Speaker')" />
                            <x-text-input id="speaker" name="speaker" type="text" class="mt-1 block w-full" />
                        </div>

                        <div>
                            <x-input-label for="recorded_at" :value="__('Recorded Date')" />
                            <x-text-input id="recorded_at" name="recorded_at" type="date" class="mt-1 block w-full" />
                        </div>

                        <div>
                            <x-input-label for="location" :value="__('Location')" />
                            <x-text-input id="location" name="location" type="text" class="mt-1 block w-full" />
                        </div>

                        <div>
                            <x-input-label for="transcript" :value="__('Transcript')" />
                            <textarea id="transcript" name="transcript" rows="8"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"></textarea>
                        </div>
                        //this is a test
                        <div>
                            <x-input-label for="audio_file" :value="__('Audio File')" />

                            <input id="audio_file" name="audio_file" type="file" accept=".mp3,.wav,.m4a,.ogg,.aac"
                                class="mt-1 block w-full text-sm text-gray-700" required />

                            <p class="mt-1 text-sm text-gray-500">
                                Supported formats: MP3, WAV, M4A, OGG, AAC.
                            </p>

                            <x-input-error :messages="$errors->get('audio_file')" class="mt-2" />
                        </div>

                        <div class="flex items-center gap-4">
                            <a href="{{ route('admin.audio.index') }}" class="px-4 py-2 bg-gray-200 rounded-md">
                                Cancel
                            </a>

                            <button type="submit" class="px-4 py-2 bg-gray-800 text-white rounded-md">
                                Save Audio
                            </button>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>

</x-app-layout>