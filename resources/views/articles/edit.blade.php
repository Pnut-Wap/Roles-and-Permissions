<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Articles') }} / Edit
            </h2>

            <a href="{{ route('articles.index') }}" class="text-white bg-slate-700 text-sm rounded-md p-2">
                Back
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('articles.update', $article->id) }}" method="post">
                        @csrf
                        @method('PUT')

                        <div>
                            <label for="title" class="text-lg font-medium">Title</label>
                            <div class="my-3">
                                <input type="text" class="border-gray-300 shadow-sm w-1/2 rounded-lg"
                                    placeholder="Title" name="title" id="title"
                                    value="{{ old('title', $article->title) }}">

                                @error('title')
                                    <p class="text-red-500 font-medium">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <label for="content" class="text-lg font-medium">Content</label>
                            <div class="my-3">
                                <textarea name="text" id="content" cols="30" rows="10" class="border-gray-300 shadow-sm w-1/2 rounded-lg"
                                    placeholder="Content">{{ old('text', $article->text) }}</textarea>

                                @error('text')
                                    <p class="text-red-500 font-medium">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <label for="author" class="text-lg font-medium">Author</label>
                            <div class="my-3">
                                <input type="text" class="border-gray-300 shadow-sm w-1/2 rounded-lg"
                                    placeholder="Author" name="author" id="author"
                                    value="{{ old('author', $article->author) }}">

                                @error('author')
                                    <p class="text-red-500 font-medium">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <button type="submit" class="text-white bg-slate-700 text-sm rounded-md px-5 py-3">
                            Update
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
