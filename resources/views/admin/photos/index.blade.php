<x-app-layout>

    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Historical Photos') }}
            </h2>

            <a href="{{ route('admin.photos.create') }}"
                class="px-4 py-2 bg-gray-800 text-white rounded-md hover:bg-gray-700">
                Add Photo
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow-sm sm:rounded-lg overflow-hidden">
                <div class="p-6">

                    @if ($photos->count())

                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

                            @foreach ($photos as $photo)

                                <div class="border rounded-lg overflow-hidden">

                                    <img src="{{ asset('storage/photos/' . $photo->filename) }}" alt="{{ $photo->title }}"
                                        class="w-full h-56 object-cover">

                                    <div class="p-4">

                                        <h3 class="font-semibold text-gray-900">
                                            {{ $photo->title }}
                                        </h3>

                                        @if ($photo->category)
                                            <p class="text-sm text-gray-500 mt-1">
                                                {{ $photo->category->name }}
                                            </p>
                                        @endif

                                        @if ($photo->photographed_at)
                                            <p class="text-sm text-gray-600 mt-2">
                                                {{ $photo->photographed_at->format('Y-m-d') }}
                                            </p>
                                        @endif
                                        <div class="mt-4 flex items-center gap-4">

                                            <a href="{{ route('admin.photos.edit', $photo) }}"
                                                class="text-blue-600 hover:text-blue-800">
                                                Edit
                                            </a>

                                            <form method="POST" action="{{ route('admin.photos.destroy', $photo) }}"
                                                onsubmit="return confirm('Are you sure you want to delete this photo?');">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" class="text-red-600 hover:text-red-800">
                                                    Delete
                                                </button>
                                            </form>

                                        </div>

                                    </div>

                                </div>

                            @endforeach

                        </div>

                        <div class="mt-6">
                            {{ $photos->links() }}
                        </div>

                    @else

                        <div class="text-center py-12">
                            <p class="text-gray-500">
                                No historical photos have been added yet.
                            </p>
                        </div>

                    @endif

                </div>
            </div>

        </div>
    </div>

</x-app-layout>