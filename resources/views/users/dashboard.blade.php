<x-layout>
    <h1>Welcome {{ auth()->user()->username }}. You have {{ $posts->total() }} posts</h1>
    <!-- component -->
    <div class="heading text-center font-bold text-3xl m-5 text-gray-800">Create a new Post</div>
    @if (session('Success'))
        <x-flashMsg msg="{{ session('Success') }}" color="text-green-500" />
    @elseif(session('delete'))
        <x-flashMsg msg="{{ session('delete') }}" color="text-red-500" />
    @endif



    <style>
        body {
            background: white !important;
        }
    </style>
    <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data"
        class="editor mx-auto w-10/12 flex flex-col text-gray-800 border border-gray-300 p-4 shadow-lg max-w-2xl">
        @csrf

        <input class="title bg-gray-100 border border-gray-300 p-2 mb-4 outline-none " spellcheck="false"
            placeholder="Title" type="text" name="title" value="{{ old('title') }}">
        <div class="text-center text-red-500 mb-3 mt-0 font-bold">
            @error('title')
                {{ $message }}
            @enderror
        </div>
        <textarea class="description bg-gray-100 sec p-3 h-60 border border-gray-300 outline-none" spellcheck="false"
            placeholder="Describe everything about this post here" name="body" value="{{ old('body') }}"></textarea>
        <div class="text-center text-red-500 mb-3 mt-0 font-bold">
            @error('body')
                {{ $message }}
            @enderror
        </div>
        <input class="title bg-gray-100 border border-gray-300 p-2 mb-4 outline-none " spellcheck="false" type="file"
            name="image">
        @error('image')
            {{ $message }}
        @enderror

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
                Post
            </button>
        </div>
    </form>

    {{-- Users latest Posts --}}
    <div class="heading text-center font-bold text-3xl m-5 text-gray-800">Your latest Posts</div>
    <div class=" grid grid-cols-2">
        @foreach ($posts as $post)
            <x-postCard :post="$post">
                {{-- Les deux points au debut  sont utilisés pour passer en parametre des objets. Dans le cas d'une variable normale on aurait fait post="{{$post}}" --}}
                {{-- Update Post --}}
                <a href="{{ route('posts.edit', $post) }}"
                    class="inline-block me-3 rounded-md border border-blue-500 py-2 px-4 w-3/12 font-bold text-blue-500 hover:text-white hover:bg-blue-500 transition-all text-center" >Edit</a>
                <form action="{{ route('posts.destroy', $post) }}" method="POST" class=" text-center">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="rounded-md border border-red-500 py-2 px-4 w-full font-bold text-red-500 hover:text-white hover:bg-red-500 transition-all">Delete</button>
                </form>

            </x-postCard>
        @endforeach
    </div>
    <div>
        {{ $posts->links() }}
    </div>

</x-layout>
