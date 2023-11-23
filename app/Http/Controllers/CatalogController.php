<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    public function getIndex()
    {
        $movies = Movie::all();
        return view('catalog.index', compact('movies'));
    }

    public function getShow($id)
    {
        $movie = Movie::findOrFail($id);
        return view('catalog.show', compact('movie'));
    }

    public function getEdit($id)
    {
        $movie = Movie::findOrFail($id);
        return view('catalog.edit', compact('movie'));
    }

    public function getCreate()
    {
        return view('catalog.create');
    }

    public function postCreate(Request $request)
    {

        $request->validate([
            'title' => 'required|string|max:255',
            'year' => 'required|integer|min:1900|max:' . date('Y'),
            'director' => 'required|string|max:255',
            'poster' => 'required|url',
            'synopsis' => 'required|string',
        ]);
    
        // Crear nueva instancia del modelo Movie
        $movie = new Movie;

        $movie->title = $request->input('title');
        $movie->year = $request->input('year');
        $movie->director = $request->input('director');
        $movie->poster = $request->input('poster', '');
        $movie->synopsis = $request->input('synopsis');
        $movie->rented = false;

        $movie->save();

        return redirect()->route('catalog.index')->with('success', '¡Película Creada con exito!');
    }

    public function putEdit(Request $request, $id)
    {

        $request->validate([
            'title' => 'required|string|max:255',
            'year' => 'required|integer|min:1900|max:' . date('Y'),
            'director' => 'required|string|max:255',
            'poster' => 'required|url',
            'synopsis' => 'required|string',
        ]);
        $movie = Movie::findOrFail($id);

        // Actualizar los campos de la película
        $movie->title = $request->input('title');
        $movie->year = $request->input('year');
        $movie->director = $request->input('director');
        //$movie->poster = $request->input('poster');
        $movie->synopsis = $request->input('synopsis');

        // Guardar la película actualizada
        $movie->save();

        // Redirección a la pantalla con la vista detalle de la película editada
        return redirect()->route('catalog.show', ['id' => $movie->id])->with('success', 'Película editada Exitosamente');
    }
    public function putRent($id)
{
    $movie = Movie::findOrFail($id);
    $movie->rented = true;
    $movie->save();
    return redirect()->route('catalog.show', ['id' => $movie->id])->with('success', 'Película alquilada Satisfactoriamente');

}

public function putReturn($id)
{
    $movie = Movie::findOrFail($id);
    $movie->rented = false;
    $movie->save();
    return redirect()->route('catalog.show', ['id' => $movie->id])->with('success', 'La Pelicula Ha sido Devuelta Satisfactoriamente');

}

public function deleteMovie($id)
{
    $movie = Movie::findOrFail($id);
    $movie->delete();
    return redirect()->route('catalog.index')->with('success', 'Película Eliminada Satisfactoriamente');

 
}
}
