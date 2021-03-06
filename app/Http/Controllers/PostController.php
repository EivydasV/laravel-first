<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth')->except('index', 'show');
    }

    public function index()
    {
        $posts = Post::paginate(5);
        return view('pages.home', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.add-post');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|unique:posts|max:255',
            'content' => 'required',
            'image' => 'sometimes|image',
         
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('public/images');
            $fileName = str_replace('public', '', $path);
            $validated = array_merge($validated, ['image' => $fileName]);
        }
        $validated = array_merge($validated, ['image' => $fileName, 'user_id' => Auth::id()]);

        Post::create($validated);

        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
    
        return view('pages.show-post', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        if(Gate::denies('edit-post', $post)){
            dd('You can perform this action');
        }
        return view('pages.edit-post', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        if(Gate::denies('edit-post', $post)){
            dd('You can perform this action');
        }

        if ($request->hasFile('image')) {

            File::delete(storage_path('app/public' . $post->image));
            $path = $request->file('image')->store('public/images');
            $fileName = str_replace('public', '', $path);
            $post->update(['image' => $fileName]);
        }
        $post->update($request->only(['title', 'content']));

        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if(Gate::denies('delete-post', $post)){
            dd('You can perform this action');
        }
        $post->delete();
        return redirect('/');
    }
}
