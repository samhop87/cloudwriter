<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Inertia\Inertia;
use Illuminate\Foundation\Application;
use Inertia\Response;

class HomePageController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Front/Home', [
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
        ]);
    }

    public function details(): Response
    {
        return Inertia::render('Front/Components/HowItWorks');
    }

    public function pricing(): Response
    {
        return Inertia::render('Front/Components/Pricing');
    }

    public function contact(): Response
    {
        return Inertia::render('Front/Components/Contact');
    }
}
