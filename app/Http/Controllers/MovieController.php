<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MovieController extends Controller
{
    public function index(): JsonResponse
    {
        $movies = Movie::all();
        return response()->json($movies, 200);
    }

    public function store(Request $request): JsonResponse
    {
        $movie = Movie::create($request->all());
        return response()->json([
            'success' => true,
            'data' => $movie
        ], 201);
    }

    public function show(string $id): JsonResponse
    {
        $movie = Movie::find($id);
        return response()->json($movie, 200);
    }

    public function update(Request $request, string $id): JsonResponse
    {
        $movie = Movie::find($id);
        $movie->title = $request->title;
        $movie->description = $request->description;
        $movie->year = $request->year;
        $movie->save();

        return response()->json([
            'success' => true,
            'data' => $movie
        ], 200);
    }

    public function destroy(string $id): JsonResponse
    {
        Movie::find($id)->delete();
        return response()->json([
            'success' => true
        ], 200);
    }

    public function getMoviesAlphabetically()
    {
        $movies = Movie::orderBy('title')->get();
        return response()->json([
            'success' => true,
            'data' => $movies
        ], 200);
    }

    public function getMoviesSortedByRating()
    {
        /**
         *Realiza una unión izquierda entre las tablas 'movies' y 'ratings' para garantizar que todas 
         *las películas estén presentes en los resultados, incluso si no tienen calificaciones asociadas 
         *en la tabla 'ratings'.
         */
        $movies = Movie::leftJoin('ratings', 'movies.id', '=', 'ratings.movie_id')
            ->selectRaw('movies.*, IFNULL(AVG(ratings.rating), 0) AS avg_rating')
            ->groupBy('movies.id', 'movies.title', 'movies.description', 'movies.year', 'movies.created_at', 'movies.updated_at')
            ->orderByDesc('avg_rating')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $movies
        ], 200);
    }
}
