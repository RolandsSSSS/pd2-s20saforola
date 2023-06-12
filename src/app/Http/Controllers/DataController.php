<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;

class DataController extends Controller
{
    // atgriež 3 nejauši izvēlētas filmas
    public function getTopMovies()
    {
        return Movie::where('display', true)
            ->inRandomOrder()
            ->take(3)
            ->get();
    }

    // atgriež izvēlētās grāmatas datus
    public function getMovie(Movie $movie)
    {
        return Movie::where([
            'id' => $movie->id,
            'display' => true,
        ])
        ->firstOrFail();
    }

    // atgriež līdzīgus ierakstus
    public function getRelatedMovies(Movie $movie)
    {
        return Movie::where('display', true)
            ->where('id', '<>', $movie->id)
            ->inRandomOrder()
            ->take(3)
            ->get();
    }
}
