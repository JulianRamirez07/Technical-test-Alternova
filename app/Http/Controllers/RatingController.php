<?php

namespace App\Http\Controllers;

use App\Http\Resources\RatingResorce;
use App\Models\Rating;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RatingController extends Controller
{
    public function index(): JsonResource
    {
        $ratings = Rating::all();
        return RatingResorce::collection($ratings, 200);
    }

    public function store(Request $request): JsonResponse
    {
        $rating = Rating::create($request->all());
        return response()->json([
            'success' => true,
            'data' => $rating
        ], 201);
    }

    public function show(string $id): JsonResource
    {
        $rating = Rating::findOrFail($id);
        return new RatingResorce($rating, 200);
    }

    public function update(Request $request, string $id): JsonResponse
    {
        $rating = Rating::find($id);
        $rating->user_id = $request->user_id;
        $rating->movie_id = $request->movie_id;
        $rating->serie_id = $request->serie_id;
        $rating->rating = $request->rating;
        $rating->save();

        return response()->json([
            'success' => true,
            'data' => $rating
        ], 200);
    }

    public function destroy(string $id): JsonResponse
    {
        Rating::find($id)->delete();
        return response()->json([
            'success' => true
        ], 200);
    }
}
