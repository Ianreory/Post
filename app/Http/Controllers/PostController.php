<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Menampilkan daftar post.
     */
    public function index()
    {
        $posts = Post::with('user')->latest()->get();
        return view('post.index', compact('posts'));
    }


    public function index_user()
    {
        $users = User::all();
        return view('post.index_user', compact('users'));
    }

    /**
     * Menampilkan form untuk membuat post baru.
     */
    public function create()
    {
        $users = User::all();
        return view('post.create', compact('users'));
    }

    /**
     * Menyimpan post baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
        ]);

        Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'date' => Carbon::now(),
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('post.index')->with('success', 'Post berhasil ditambahkan!');
    }

    /**
     * Menampilkan detail post berdasarkan ID.
     */
    public function show(Post $post)
    {

        return view('posts.show', compact('post'));
    }

    /**
     * Menampilkan form edit post.
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        return view('post.edit', compact('post'));
    }

    /**
     * Memperbarui post yang sudah ada.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $post = Post::findOrFail($id);
        $post->update([
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return redirect()->route('post.index')->with('success', 'Post berhasil diperbarui.');
    }

    /**
     * Menghapus post.
     */
    public function destroy($idpost)
    {
        $post = Post::where('idpost', $idpost)->firstOrFail();
        $post->delete();
        return redirect()->route('post.index')->with('success', 'Post berhasil dihapus!');
    }

}
