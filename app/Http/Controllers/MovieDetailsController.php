<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MovieDetailsController extends Controller
{
    public function show($id)
    {

        return view("movies.details");
    } 
}
