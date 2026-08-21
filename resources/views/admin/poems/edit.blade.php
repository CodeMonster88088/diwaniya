<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Poem') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-6">

                    <form
                        method="POST"
                        action="{{ route('admin.poems.update', $poem) }}"
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
                                value="{{ old('title', $poem->title) }}"
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
                                        @selected(old('category_id', $poem->category_id) == $category->id)
                                    >
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>

                            <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="poet" :value="__('Poet')" />

                            <x-text-input
                                id="poet"
                                name="poet"
                                type="text"
                                class="mt-1 block w-full"
                                value="{{ old('poet', $poem->poet) }}"
                            />

                            <x-input-error :messages="$errors->get('poet')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="written_at" :value="__('Written Date')" />

                            <x-text-input
                                id="written_at"
                                name="written_at"
                                type="date"
                                class="mt-1 block w-full"
                                value="{{ old('written_at', $poem->written_at?->format('Y-m-d')) }}"
                            />

                            <x-input-error :messages="$errors->get('written_at')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="description" :value="__('Description')" />

                            <textarea
                                id="description"
                                name="description"
                                rows="3"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                            >{{ old('description', $poem->description) }}</textarea>

                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="content" :value="__('Poem')" />

                            <textarea
                                id="content"
                                name="content"
                                rows="16"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm font-serif"
                                required
                            >{{ old('content', $poem->content) }}</textarea>

                            <x-input-error :messages="$errors->get('content')" class="mt-2" />
                        </div>

                        <div class="flex items-center gap-3">
                            <input
                                id="is_published"
                                name="is_published"
                                type="checkbox"
                                value="1"
                                class="rounded border-gray-300"
                                @checked(old('is_published', $poem->is_published))
                            >

                            <x-input-label
                                for="is_published"
                                :value="__('Published')"
                            />
                        </div>

                        <div class="flex items-center gap-4">
                            <a
                                href="{{ route('admin.poems.index') }}"
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