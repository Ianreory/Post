<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Menampilkan daftar post.
     */
    public function index()
    {
        $posts = Post::with('user')->latest()->get();
        return view('posts.index', compact('posts'));
    }

    /**
     * Menampilkan form untuk membuat post baru.
     */
    public function create()
    {
        $users = User::all(); // Ambil semua user untuk dropdown (jika perlu)
        return view('posts.create', compact('users'));
    }

    /**
     * Menyimpan post baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'date' => 'required|date',
            'user_id' => 'required|exists:users,id',
        ]);

        Post::create($request->all());

        return redirect()->route('posts.index')->with('success', 'Post berhasil ditambahkan!');
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
    public function edit(Post $post)
    {
        $users = User::all();
        return view('posts.edit', compact('post', 'users'));
    }

    /**
     * Memperbarui post yang sudah ada.
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'date' => 'required|date',
            'user_id' => 'required|exists:users,id',
        ]);

        $post->update($request->all());

        return redirect()->route('posts.index')->with('success', 'Post berhasil diperbarui!');
    }

    /**
     * Menghapus post.
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('posts.index')->with('success', 'Post berhasil dihapus!');
    }
}
