<?php

namespace App\Http\Controllers;

use App\Models\Serie;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SerieController extends Controller
{
    public function index(): JsonResponse
    {
        $series = Serie::all();
        return response()->json($series, 200);
    }

    public function store(Request $request): JsonResponse
    {
        $serie = Serie::create($request->all());
        return response()->json([
            'success' => true,
            'data' => $serie
        ], 201);
    }

    public function show(string $id): JsonResponse
    {
        $serie = Serie::find($id);
        return response()->json($serie, 200);
    }

    public function update(Request $request, string $id): JsonResponse
    {
        $serie = Serie::find($id);
        $serie->title = $request->title;
        $serie->description = $request->description;
        $serie->start_year = $request->start_year;
        $serie->end_year = $request->end_year;
        $serie->save();

        return response()->json([
            'success' => true,
            'data' => $serie
        ], 200);
    }

    public function destroy(string $id): JsonResponse
    {
        Serie::find($id)->delete();
        return response()->json([
            'success' => true
        ], 200);
    }

    public function getSeriesAlphabetically()
    {
        $movies = Serie::orderBy('title')->get();
        return response()->json([
            'success' => true,
            'data' => $movies
        ], 200);
    }

    public function getSeriesSortedByRating()
    {
        /**
         *Realiza una unión izquierda entre las tablas 'series' y 'ratings' para garantizar que todas 
         *las series estén presentes en los resultados, incluso si no tienen calificaciones asociadas 
         *en la tabla 'ratings'.
         */
        $movies = Serie::leftJoin('ratings', 'series.id', '=', 'ratings.serie_id')
            ->selectRaw('series.*, IFNULL(AVG(ratings.rating), 0) AS avg_rating')
            ->groupBy('series.id', 'series.title', 'series.description', 'series.start_year', 'series.end_year', 'series.created_at', 'series.updated_at')
            ->orderByDesc('avg_rating')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $movies
        ], 200);
    }
}
