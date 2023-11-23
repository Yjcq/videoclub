<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use Illuminate\Http\Request;

class APICatalogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json( Movie::all() );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'year' => 'required|integer',
            'director' => 'required|string',
            'poster' => 'required|url',
            'synopsis' => 'required|string',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['error' => true, 'msg' => 'Error de validación', 'errors' => $validator->errors()], 400);
            $movie = Movie::create($request->all());

            return response()->json(['error' => false, 'msg' => 'Película creada correctamente', 'data' => $movie], 201);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $movie = Movie::findOrFail($id);
            return response()->json(['error' => false, 'data' => $movie]);
        } catch (\Exception $e) {
            return response()->json(['error' => true, 'msg' => 'Película no encontrada'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'year' => 'required|integer',
            'director' => 'required|string',
            'poster' => 'required|url',
            'synopsis' => 'required|string',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['error' => true, 'msg' => 'Error de validación', 'errors' => $validator->errors()], 400);
        }
    
        $movie = Movie::findOrFail($id);
        $movie->update($request->all());
    
        return response()->json(['error' => false, 'msg' => 'Película actualizada correctamente', 'data' => $movie]);
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $movie = Movie::findOrFail($id);
        $movie->delete();
    
        return response()->json(['error' => false, 'msg' => 'Película eliminada correctamente']);
    }
        public function putRent($id)
    {
        $m = Movie::findOrFail( $id );
        $m->rented = true;
        $m->save();
        return response()->json( ['error' => false,
                              'msg' => 'La película se ha marcado como alquilada' ] );
    }
    public function putReturn($id)
    {
        $m = Movie::findOrFail( $id );
        $m->rented = false;
        $m->save();
        return response()->json( ['error' => false,
                              'msg' => 'La película se ha marcado como disponible' ] );
    }

    
}
