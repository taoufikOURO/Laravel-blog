<x-layout>
    <div class="heading text-center font-bold text-3xl m-5 text-gray-800">{{$user->username}}'s posts &#9830 {{ $posts->total() }}</div>

    {{--User's Post--}}
    @foreach ($posts as $post)
    <x-postCard :post="$post" /> {{--Les deux points au debut  sont utilisés pour passer en parametre des objets. Dans le cas d'une variable normale on aurait fait post="{{$post}}" --}}
    @endforeach
    <div>
        {{$posts->links()}}
    </div>
</x-layout>