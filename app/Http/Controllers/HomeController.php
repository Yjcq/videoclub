<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function getHome($id)
{
    // return view('home');
    
    return redirect()->action([CatalogController::class, 'getIndex']);
}


    //
}
