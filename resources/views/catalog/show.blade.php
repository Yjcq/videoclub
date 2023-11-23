@extends('layouts.master')

@section('content')
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

   Vista detalle películas

   <div class="row">

      <div class="col-sm-4">
  
        <img src="{{ $movie['poster'] }}" alt="Imagen de la película">
    </div>
    <div class="col-sm-8">
        <div style="margin-top: 20px;">
            <a href="{{ route('catalog.update', ['id' => $movie['id']]) }}" class="btn btn-warning">Editar película</a>
    
            <a href="{{ route('catalog.index') }}" class="btn btn-secondary">Volver a la lista de películas</a>
        </div>  <br>
        {{-- Datos de la película --}}
        <h2>{{ $movie['title'] }}</h2>
        <p><strong>Año:</strong> {{ $movie['year'] }}</p>
        <p><strong>Director:</strong> {{ $movie['director'] }}</p>
        <p><strong>Resumen:</strong> {{ $movie['synopsis'] }}</p>

        {{-- Estado de la película --}}
        @if ($movie['rented'])
            <p><strong>Estado:</strong> Película actualmente alquilada</p>
            <button class="btn btn-danger">Pelicula Actualmente Alquilada</button>
        @else
            <p><strong>Estado:</strong> Película disponible</p>
            <button class="btn btn-primary">Pelicula Disponible</button>
        @endif

        {{-- Botones adicionales --}}
        <div style="margin-top: 20px;">
            
            @if ($movie->rented)
            <form action="{{ route('catalog.return', ['id' => $movie->id]) }}" method="POST" style="display: inline;" onsubmit="return confirm('¿Estás seguro de devolver esta película?');">
                @csrf
                @method('PUT')
                <button type="submit" class="btn btn-success">Devolver película</button>
            </form>
        @else
            <form action="{{ route('catalog.rent', ['id' => $movie->id]) }}" method="POST" style="display: inline;" onsubmit="return confirm('¿Deseas alquilar esta pelicula?');">
                @csrf
                @method('PUT')
                <button type="submit" class="btn btn-primary">Alquilar película</button>
            </form>
        @endif
        
        <form action="{{ route('catalog.delete', ['id' => $movie->id]) }}" method="POST" style="display: inline;" onsubmit="return confirm('¿Estas seguro eliminar esta película?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Eliminar película</button>
        </form>
        </div>
      </div>
  </div>
  
@endsection
