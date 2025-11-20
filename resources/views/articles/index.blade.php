<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Articles') }}
            </h2>

            @can('create articles')
                <a href="{{ route('articles.create') }}" class="text-white bg-slate-700 text-sm rounded-md p-2">
                    Create
                </a>
            @endcan

        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-message />

            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr class="border-b">
                        <th class="px-6 py-3 text-left">#</th>
                        <th class="px-6 py-3 text-left">Title</th>
                        <th class="px-6 py-3 text-left">Author</th>
                        <th class="px-6 py-3 text-left">Created At</th>
                        <th class="px-6 py-3 text-center">Action</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    @forelse ($articles as $article)
                        <tr class="border-b">
                            <td class="px-6 py-3 text-left">{{ $article->id }}</td>
                            <td class="px-6 py-3 text-left">{{ $article->title }}</td>
                            <td class="px-6 py-3 text-left">{{ $article->author }}</td>
                            <td class="px-6 py-3 text-left">
                                {{ \Carbon\Carbon::parse($article->created_at)->format('d M, Y') }}
                            </td>
                            <td class="px-6 py-3 text-center flex space-x-2">
                                @can('edit articles')
                                    <a href="{{ route('articles.edit', $article->id) }}"
                                        class="text-white bg-slate-700 text-sm rounded-md p-2">
                                        Edit
                                    </a>
                                @endcan

                                @can('delete articles')
                                    <form action="{{ route('articles.destroy', $article->id) }}" method="POST"
                                        onsubmit="return confirm('Are you sure?')" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-white bg-red-700 text-sm rounded-md p-2">
                                            Delete
                                        </button>
                                    </form>
                                @endcan
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-3 text-center text-gray-500">No articles found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="my-3">
                {{ $articles->links() }}
            </div>

        </div>
    </div>
</x-app-layout>
