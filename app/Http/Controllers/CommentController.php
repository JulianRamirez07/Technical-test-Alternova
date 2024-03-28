<?php

namespace App\Http\Controllers;

use App\Http\Resources\CommentResorce;
use App\Models\Comment;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentController extends Controller
{
    public function index(): JsonResource
    {
        $comments = Comment::all();
        return CommentResorce::collection($comments, 200);
    }

    public function store(Request $request): JsonResponse
    {
        $comment = Comment::create($request->all());
        return response()->json([
            'success' => true,
            'data' => $comment
        ], 201);
    }

    public function show(string $id): JsonResource
    {
        $comment = Comment::findOrFail($id);
        return new CommentResorce($comment, 200);
    }

    public function update(Request $request, string $id): JsonResponse
    {
        $comment = Comment::find($id);
        $comment->user_id = $request->user_id;
        $comment->movie_id = $request->movie_id;
        $comment->serie_id = $request->serie_id;
        $comment->comment = $request->comment;
        $comment->save();

        return response()->json([
            'success' => true,
            'data' => $comment
        ], 200);
    }

    public function destroy(string $id): JsonResponse
    {
        Comment::find($id)->delete();
        return response()->json([
            'success' => true
        ], 200);
    }
}
