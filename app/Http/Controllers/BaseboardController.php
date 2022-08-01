<?php

namespace App\Http\Controllers;

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
        ]);
    }
}
