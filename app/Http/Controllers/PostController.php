<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\PostResource;

class PostController extends Controller
{
    public function index(): JsonResponse
    {
    return response()->json([
        'data' => PostResource::collection(Post::with(['user', 'comments'])->get())
    ]);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $post = Post::create($validated);

        return response()->json([
            'data' => $post
        ], 201);
    }

    public function show(Post $post): JsonResponse
    {
        $post->load(['user', 'comments']);

        return response()->json([
            'data' => new PostResource($post)
        ]);
    }

    public function update(Request $request, Post $post): JsonResponse
    {
        $validated = $request->validate([
            'title' => 'sometimes|string|max:255',
            'content' => 'sometimes|string',
        ]);

        $post->update($validated);

        return response()->json([
            'data' => $post
        ]);
    }

    public function destroy(Post $post): JsonResponse
    {
        $post->delete();

        return response()->json([
            'message' => 'Post deleted'
        ]);
    }
}
