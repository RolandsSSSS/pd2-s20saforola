<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Director;
use App\Models\Genre;

class MovieController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // display all movies
    public function list()
    {
        $items = Movie::orderBy('id', 'asc')->get();

        return view(
            'movie.list',
            [
                'title' => 'Filmas',
                'items' => $items,
            ]
        );
    }

    // display new movie form
    public function create()
    {
        $directors = Director::orderBy('name', 'asc')->get();
        $genres = Genre::orderBy('name', 'asc')->get();

        return view(
            'movie.form',
            [
                'title' => 'Pievienot jaunu filmu',
                'movie' => new Movie(),
                'directors' => $directors,
                'genres' => $genres,
            ]
        );
    }

    // save new movie
    public function put(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|min:3|max:256',
            'director_id' => 'required',
            'genre_id' => 'required',
            'description' => 'nullable',
            'price' => 'nullable|numeric',
            'year' => 'numeric',
            'image' => 'nullable|image',
            'display' => 'nullable'
        ]);

        $movie = new Movie();
        $movie->name = $validatedData['name'];
        $movie->director_id = $validatedData['director_id'];
        $movie->genre_id = $validatedData['genre_id'];
        $movie->description = $validatedData['description'];
        $movie->price = $validatedData['price'];
        $movie->year = $validatedData['year'];
        $movie->display = (bool) ($validatedData['display'] ?? false);
        
        if ($request->hasFile('image')) {
            $uploadedFile = $request->file('image');
            $extension = $uploadedFile->clientExtension();
            $name = uniqid();
            $movie->image = $uploadedFile->storePubliclyAs('/', $name . '.' . $extension, 'uploads');
        }           
        $movie->save();

        return redirect('/movies');
    }

    // display movie update form
    public function update(Movie $movie)
    {
        $directors = Director::orderBy('name', 'asc')->get();
        $genres = Genre::orderBy('name', 'asc')->get();
        
        return view(
            'movie.form',
            [
                'title' => 'Rediģēt filmu',
                'movie' => $movie,
                'directors' => $directors,
                'genres' => $genres
            ]
        );
    }

    // update existing movies
    public function patch(Movie $movie, Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|min:3|max:256',
            'director_id' => 'required',
            'genre_id' => 'required',
            'description' => 'nullable',
            'price' => 'nullable|numeric',
            'year' => 'numeric',
            'image' => 'nullable|image',
            'display' => 'nullable'     
        ]);

        $movie->name = $validatedData['name'];
        $movie->director_id = $validatedData['director_id'];
        $movie->genre_id = $validatedData['genre_id'];
        $movie->description = $validatedData['description'];
        $movie->price = $validatedData['price'];
        $movie->year = $validatedData['year'];
        $movie->display = (bool) ($validatedData['display'] ?? false);
        $movie->save();

        return redirect('/movies');
    }

    // delete movie
    public function delete(Movie $movie)
    {
        $movie->delete();
        return redirect('/movies');
    }
}
