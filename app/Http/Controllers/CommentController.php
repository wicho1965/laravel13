<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class CommentController extends Controller
{
    // GET /api/comments
    public function index(): JsonResponse
    {
        return response()->json([
            'data' => Comment::with(['user', 'post'])->get()
        ]);
    }

    // POST /api/comments
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'post_id' => 'required|exists:posts,id',
            'body' => 'required|string',
        ]);

        $comment = Comment::create([
            'user_id' => $request->user()->id,
            'post_id' => $validated['post_id'],
            'body' => $validated['body'],
        ]);

        return response()->json([
            'data' => $comment
        ], 201);
    }

    // GET /api/comments/{comment}
    public function show(Comment $comment): JsonResponse
    {
        return response()->json([
            'data' => $comment->load(['user', 'post'])
        ]);
    }

    // PUT /api/comments/{comment}
    public function update(Request $request, Comment $comment): JsonResponse
    {
        $validated = $request->validate([
            'post_id' => 'sometimes|exists:posts,id',
            'body' => 'sometimes|string',
        ]);

        $comment->update($validated);

        return response()->json([
            'data' => $comment
        ]);
    }

    // DELETE /api/comments/{comment}
    public function destroy(Comment $comment): JsonResponse
    {
        $comment->delete();

        return response()->json([
            'message' => 'Comment deleted'
        ]);
    }
}