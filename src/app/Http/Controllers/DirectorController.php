<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Director;

class DirectorController extends Controller
{
    // display all directors
    public function list()
    {
        $items = Director::orderBy('name', 'asc')->get();

        return view(
            'director.list',
            [
                'title' => 'Režisori',
                'items' => $items,
            ]
        );
    }

    // display new director form
    public function create()
    {
        return view(
            'director.form',
            [
                'title' => 'Pievienot jaunu režisoru',
                'director' => new Director(),
            ]
        );
    }

    // save new director
    public function put(Request $request)
    {
        $validatedDate = $request->validate([
            'name' => 'required',
        ]);

        $director = new Director();
        $director->name = $validatedDate['name'];
        $director->save();

        return redirect('/directors');
    }

    // display author update form
    public function update(Director $director)
    {
        return view(
            'director.form',
            [
                'title' => 'Rediģēt režisoru',
                'director' => $director,
            ]
        );
    }

    // update existing directors
    public function patch(Director $director, Request $request)
    {
        $validatedDate = $request->validate([
            'name' => 'required',
        ]);

        $director->name = $validatedDate['name'];
        $director->save();

        return redirect('/directors');
    }

    // delete directors
    public function delete(Director $director)
    {
        $director->delete();
        return redirect('/directors');
    }
}
