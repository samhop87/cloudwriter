<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProjectResource;
use Illuminate\Foundation\Application;
use Inertia\Inertia;
use Inertia\Response;

class BaseboardController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Baseboard', [
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
            'projects' => ProjectResource::collection(auth()->user()->projects),
        ]);
    }
}
