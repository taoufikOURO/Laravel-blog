<x-layout>
    <h1 class="title">Latest Posts</h1>
    <div class=" grid grid-cols-2">
        @foreach ($posts as $post)
        <x-postCard :post="$post" /> {{--Les deux points au debut  sont utilisés pour passer en parametre des objets. Dans le cas d'une variable normale on aurait fait post="{{$post}}" --}}
        @endforeach
    </div>
    <div>
        {{$posts->links()}}
    </div>
</x-layout>