<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    // GET /api/comments
    public function index()
    {
        return response()->json([
            'data' => Comment::with(['user', 'post'])->get()
        ]);
    }

    // POST /api/comments
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'post_id' => 'required|exists:posts,id',
            'body' => 'required|string',
        ]);

        $comment = Comment::create($validated);

        return response()->json([
            'data' => $comment
        ], 201);
    }

    // GET /api/comments/{comment}
    public function show(Comment $comment)
    {
        return response()->json([
            'data' => $comment->load(['user', 'post'])
        ]);
    }

    // PUT /api/comments/{comment}
    public function update(Request $request, Comment $comment)
    {
        $validated = $request->validate([
            'user_id' => 'sometimes|exists:users,id',
            'post_id' => 'sometimes|exists:posts,id',
            'body' => 'sometimes|string',
        ]);

        $comment->update($validated);

        return response()->json([
            'data' => $comment
        ]);
    }

    // DELETE /api/comments/{comment}
    public function destroy(Comment $comment)
    {
        $comment->delete();

        return response()->json([
            'message' => 'Comment deleted'
        ]);
    }
}