<?php

namespace App\Http\Controllers;

use App\Http\Resources\GenreResource;
use App\Models\Genre;

class GenreController extends Controller
{
    public function index()
    {
        return GenreResource::collection(Genre::whereNull('parent_id')->with('subGenres')->get());
    }
}
