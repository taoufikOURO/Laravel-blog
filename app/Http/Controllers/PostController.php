<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{

    public static function middleware() :array
    {
        return [
            new Middleware('auth', except: ['index', 'show'])
        ];
    }

    
    public function index()
    {
        $posts = Post::latest()->paginate(3);

        return view('posts.index', [
            "posts" => $posts
        ]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //Valider la saisie
        $request->validate([
            'title' => ['required', 'max:255'],
            'body' => ['required'],
            'image' => ['nullable', 'file', 'max:3000', 'mimes:png,jpg,webp']
        ]);

        //POur uploader une image
        $path = null;
        if($request->hasFile('image'))
        {
            $path = Storage::disk('public')->put('/posts_images', $request->image);
        }

        //Créer le post
        Auth::user()->posts()->create([
            'title' => $request->title,
            'body' => $request->body,
            'image' => $path,
        ]);

        //rediriger l'utilisteur
        return back()->with("Success", "Your Post was created");
    }

    public function show(Post $post)
    {
        return view ('posts.show', ['post' => $post]);
    }


    /*
    *
    *
        FORMULAIRE DE MISE A JOUR
    *
    */
    public function edit(Post $post)
    {
        Gate::authorize('modify', $post);
        return view('posts.edit', ['post'=>$post]);
    }





    /*
    *
    *
        METTRE AJOUR LE POST
    *
    */
    public function update(Request $request, Post $post)
    {
        //Valider la saisie
        $request->validate([
            'title' => ['required', 'max:255'],
            'body' => ['required'],
            'image' => ['nullable', 'file', 'max:3000', 'mimes:png,jpg,webp']
        ]);

        $path = $post->image ?? null;
        if($request->hasFile('image'))
        {
            if($post->image)
            {
                Storage::disk('public')->delete($post->image);
            }
            $path = Storage::disk('public')->put('/posts_images', $request->image);
        }

        //Mettre ajour le post
        $post->update([
            'title' => $request->title,
            'body' => $request->body,
            'image' => $path,
        ]);

        //rediriger l'utilisteur
        return redirect()->route('dashboard')->with("Success", "Your Post was updated");
    }




    /*
    *
    *
        SUPPRIMER LE POST
    *
    */

    public function destroy(Post $post)
    {
        //Delete Post Image if the post not exists
        if($post->image)
        {
            Storage::disk('public')->delete($post->image);
        }

        //Delete the Post
        $post->delete();

        //redirect
        return back()->with('delete', 'Your Post was deleted!');
    }
}
