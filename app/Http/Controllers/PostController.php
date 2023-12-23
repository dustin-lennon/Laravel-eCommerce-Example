<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    public function __construct()
    {
        // $this->middleware('authCheck2')->except('index');
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Cache::remember('posts-page-' . request('page', 1), 60 * 3, function () {
            return Post::with('category')->paginate(5);
        });

        return view('index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Post::class);

        $categories = Category::all();

        return view('create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', Post::class);

        $request->validate([
            'image' => ['required', 'image', 'max: 2048', 'mimes:jpg,png,jpeg,gif,svg,webp'],
            'title' => ['required', 'max: 255'],
            'category' => ['required', 'integer'],
            'description' => ['required',],
        ]);

        $filename = time() . '_' . $request->image->getClientOriginalName();
        $filePath = $request->image->storeAs('uploads', $filename);

        $post = new Post();

        $post->image = 'storage/' . $filePath;
        $post->title = $request->title;
        $post->category_id = $request->category;
        $post->description = $request->description;
        $post->save();

        return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = Post::findOrFail($id);

        return view('show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $post = Post::findOrFail($id);

        $this->authorize('update', $post);

        $categories = Category::all();

        return view('edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $post = Post::findOrFail($id);

        $this->authorize('update', $post);

        $request->validate([
            'title' => ['required', 'max: 255'],
            'category' => ['required', 'integer'],
            'description' => ['required',],
        ]);

        if ($request->hasFile('image')) {
            $request->validate([
                'image' => ['required', 'image', 'max: 2048', 'mimes:jpg,png,jpeg,gif,svg,webp'],
            ]);

            $filename = time() . '_' . $request->image->getClientOriginalName();
            $filePath = $request->image->storeAs('uploads', $filename);

            File::delete(public_path($post->image));

            $post->image = 'storage/' . $filePath;
        }

        $post->title = $request->title;
        $post->category_id = $request->category;
        $post->description = $request->description;
        $post->save();

        return redirect()->route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Post::findOrFail($id);

        $this->authorize('delete', $post);

        $post->delete();

        return redirect()->route('posts.index');
    }

    public function trashed()
    {
        $posts = Post::onlyTrashed()->get();

        $this->authorize('delete', $posts);

        return view('trashed', compact('posts'));
    }

    public function restore(string $id)
    {
        $post = Post::onlyTrashed()->findOrFail($id);

        $this->authorize('delete', $post);

        $post->restore();

        return redirect()->back();
    }

    public function forceDelete(string $id)
    {
        $this->authorize('delete', Post::class);

        $post = Post::onlyTrashed()->findOrFail($id);

        File::delete(public_path($post->image));

        $post->forceDelete();

        return redirect()->back();
    }
}
