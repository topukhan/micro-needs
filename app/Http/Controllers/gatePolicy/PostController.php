<?php

namespace App\Http\Controllers\gatePolicy;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->get();
        return view('gatePolicy.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('gatePolicy.create');
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|min:5'
        ]);
        // dd($request->all());
        try {
            auth()->user()->posts()->create([
                'content' => $request['content'],
            ]);
            return redirect()->route('posts.index')->with(['message' => 'Post Created Successfully']);
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('gatePolicy.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( Post $post)
    {
        return view('gatePolicy.edit', compact('post'));
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        if (! Gate::allows('update-post', $post)) {
            abort(403);
        }
        
        $request->validate([
            'content' => 'required|min:5'
        ]);
        // dd($request->all());
        try {
            $post->update([
                'content' => $request['content'],
            ]);
            return redirect()->route('posts.index')->with(['message' => 'Post Updated Successfully']);
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            // Find the post by its ID
            $post = Post::findOrFail($id);
            
            // Delete the post
            $post->delete();
            
            return redirect()->route('posts.index')->with(['message' => 'Post deleted successfully']);
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
}
