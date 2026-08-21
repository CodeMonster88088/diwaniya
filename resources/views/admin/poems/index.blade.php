<x-app-layout>

    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Poems') }}
            </h2>

            <a <a href="{{ route('admin.poems.create') }}"
                class="px-4 py-2 bg-gray-800 text-white rounded-md hover:bg-gray-700">
                Add Poem
            </a>
        </div>
        <th class="px-4 py-3 text-sm font-semibold text-gray-600">
            Actions
        </th>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow-sm sm:rounded-lg overflow-hidden">
                <div class="p-6">

                    @if ($poems->count())

                        <div class="overflow-x-auto">
                            <table class="w-full text-left">
                                <thead>
                                    <tr class="border-b">
                                        <th class="px-4 py-3 text-sm font-semibold text-gray-600">
                                            Title
                                        </th>

                                        <th class="px-4 py-3 text-sm font-semibold text-gray-600">
                                            Poet
                                        </th>

                                        <th class="px-4 py-3 text-sm font-semibold text-gray-600">
                                            Category
                                        </th>

                                        <th class="px-4 py-3 text-sm font-semibold text-gray-600">
                                            Written
                                        </th>

                                        <th class="px-4 py-3 text-sm font-semibold text-gray-600">
                                            Status
                                        </th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($poems as $poem)
                                        <tr class="border-b last:border-b-0">

                                            <td class="px-4 py-4">
                                                <div class="font-medium text-gray-900">
                                                    {{ $poem->title }}
                                                </div>
                                            </td>

                                            <td class="px-4 py-4 text-gray-700">
                                                {{ $poem->poet ?: '—' }}
                                            </td>

                                            <td class="px-4 py-4 text-gray-700">
                                                {{ $poem->category?->name ?: '—' }}
                                            </td>

                                            <td class="px-4 py-4 text-gray-700">
                                                {{ $poem->written_at?->format('Y-m-d') ?: '—' }}
                                            </td>

                                            <td class="px-4 py-4">
                                                @if ($poem->is_published)
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
                                                <div class="flex items-center gap-4">

                                                    <a href="{{ route('admin.poems.edit', $poem) }}"
                                                        class="text-blue-600 hover:text-blue-800">
                                                        Edit
                                                    </a>

                                                    <form method="POST" action="{{ route('admin.poems.destroy', $poem) }}"
                                                        onsubmit="return confirm('Are you sure you want to delete this poem?');">
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
                            {{ $poems->links() }}
                        </div>

                    @else

                        <div class="text-center py-12">
                            <p class="text-gray-500">
                                No poems have been added yet.
                            </p>
                        </div>

                    @endif

                </div>
            </div>

        </div>
    </div>

</x-app-layout>