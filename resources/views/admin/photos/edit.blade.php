<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Historical Photo') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-6">

                    <form
                        method="POST"
                        action="{{ route('admin.photos.update', $photo) }}"
                        enctype="multipart/form-data"
                        class="space-y-6"
                    >
                        @csrf
                        @method('PUT')

                        <div>
                            <x-input-label for="title" :value="__('Title')" />

                            <x-text-input
                                id="title"
                                name="title"
                                type="text"
                                class="mt-1 block w-full"
                                value="{{ old('title', $photo->title) }}"
                                required
                            />

                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>

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
                                        @selected(old('category_id', $photo->category_id) == $category->id)
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
                            >{{ old('description', $photo->description) }}</textarea>

                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="photographed_at" :value="__('Photographed Date')" />

                            <x-text-input
                                id="photographed_at"
                                name="photographed_at"
                                type="date"
                                class="mt-1 block w-full"
                                value="{{ old('photographed_at', $photo->photographed_at?->format('Y-m-d')) }}"
                            />

                            <x-input-error :messages="$errors->get('photographed_at')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="location" :value="__('Location')" />

                            <x-text-input
                                id="location"
                                name="location"
                                type="text"
                                class="mt-1 block w-full"
                                value="{{ old('location', $photo->location) }}"
                            />

                            <x-input-error :messages="$errors->get('location')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="people" :value="__('People in Photo')" />

                            <textarea
                                id="people"
                                name="people"
                                rows="3"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                            >{{ old('people', $photo->people) }}</textarea>

                            <x-input-error :messages="$errors->get('people')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="photographer" :value="__('Photographer')" />

                            <x-text-input
                                id="photographer"
                                name="photographer"
                                type="text"
                                class="mt-1 block w-full"
                                value="{{ old('photographer', $photo->photographer) }}"
                            />

                            <x-input-error :messages="$errors->get('photographer')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label :value="__('Current Photo')" />

                            <img
                                src="{{ asset('storage/photos/' . $photo->filename) }}"
                                alt="{{ $photo->title }}"
                                class="mt-2 max-w-md rounded-lg shadow"
                            />
                        </div>

                        <div>
                            <x-input-label for="photo" :value="__('Replace Photo')" />

                            <input
                                id="photo"
                                name="photo"
                                type="file"
                                accept=".jpg,.jpeg,.png,.webp"
                                class="mt-1 block w-full"
                            >

                            <p class="mt-1 text-sm text-gray-500">
                                Leave empty to keep the current photo.
                            </p>

                            <x-input-error :messages="$errors->get('photo')" class="mt-2" />
                        </div>

                        <div class="flex items-center gap-3">
                            <input
                                id="is_published"
                                name="is_published"
                                type="checkbox"
                                value="1"
                                class="rounded border-gray-300"
                                @checked(old('is_published', $photo->is_published))
                            >

                            <x-input-label
                                for="is_published"
                                :value="__('Published')"
                            />
                        </div>

                        <div class="flex items-center gap-4">
                            <a
                                href="{{ route('admin.photos.index') }}"
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