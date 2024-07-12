<x-layout>
    <div class="text-sm mb-3">
        <a href="{{ route('dashboard') }}" class="text-blue-500 font-medium"> &larr; Go back to your dashboard </a>
    </div>
    <div class="heading text-center font-bold text-3xl m-5 text-gray-800">Edit the Post</div>

    <style>
        body {
            background: white !important;
        }
    </style>
    <form action="{{ route('posts.update', $post) }}" method="POST" enctype="multipart/form-data"
        class="editor mx-auto w-10/12 flex flex-col text-gray-800 border border-gray-300 p-4 shadow-lg max-w-2xl">
        @csrf
        @method('PUT')

        <input class="title bg-gray-100 border border-gray-300 p-2 mb-4 outline-none " spellcheck="false"
            placeholder="Title" type="text" name="title" value="{{ $post->title }}">
        <div class="text-center text-red-500 mb-3 mt-0 font-bold">
            @error('title')
                {{ $message }}
            @enderror
        </div>
        <textarea class="description bg-gray-100 sec p-3 h-60 border border-gray-300 outline-none" spellcheck="false"
            placeholder="Describe everything about this post here" name="body">{{ $post->body }}</textarea>
        <div class="text-center text-red-500 mb-3 mt-0 font-bold">
            @error('body')
                {{ $message }}
            @enderror
        </div>
        @if ($post->image)
            <div class="text-start">
                <label for="image" class="text-gray-600 font-medium text-sm">Current post photo</label>
                <img src="{{ asset('storage/' . $post->image) }}" alt="" class="rounded-lg w-2/5">
            </div>
        @endif
        <input class="title bg-gray-100 border border-gray-300 p-2 mb-4 mt-3 outline-none " spellcheck="false"
            type="file" name="image">
        <div class="text-center text-red-500 mb-3 mt-0 font-bold">
            @error('image')
                {{ $message }}
            @enderror
        </div>

        <!-- icons -->
        <div class="icons flex text-gray-500 m-2">
            <svg class="mr-2 cursor-pointer hover:text-gray-700 border rounded-full p-1 h-7"
                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
            <svg class="mr-2 cursor-pointer hover:text-gray-700 border rounded-full p-1 h-7"
                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <svg class="mr-2 cursor-pointer hover:text-gray-700 border rounded-full p-1 h-7"
                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
            </svg>
        </div>
        <!-- buttons -->
        <div class=" inline-block items-center text-end">
            <button
                class="btn border border-indigo-500 p-1 px-4 font-semibold cursor-pointer text-gray-200 ml-2 bg-indigo-500 rounded-md w-1/5">
                update
            </button>
        </div>
    </form>
</x-layout>
