@extends('layouts.master')

@section('title' , 'Videoclub')
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
@section('content')

    Listado peliculas

    <div class="row">

        @foreach( $movies as $movie )
        <div class="col-xs-6 col-sm-4 col-md-3 text-center">
    
            <a href="{{ url('/catalog/show/'. $movie->id ) }}">
                <img src="{{$movie->poster}}" style="height:200px"/>
                <h4 style="min-height:45px;margin:5px 0 10px 0">
                    {{$movie->title}}
                </h4>
            </a>
    
        </div>
        @endforeach
    
    </div>
@endsection