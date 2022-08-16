<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Inertia\Middleware;
use Tightenco\Ziggy\Ziggy;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function version(Request $request)
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function share(Request $request): array
    {
        $isAdminRoute = Str::contains(url()->current(), 'admin');
        $frontPage    = url()->current() === config('app.url');

        return array_merge(parent::share($request), [
            'auth' => [
                'user' => [
                    'id' => Auth::check() ? Auth::id() : null,
                    'name' => Auth::check() ? Auth::user()->name : null,
                    'drive_token' => Auth::check() ? Auth::user()->drive_token : null, // change to bool
                ],
                'admin' => $request->user() ? $request->user()->hasRole('admin') : null
            ],
            'current_project' => session('current_project'),
            'current_file' => session('global_activated_file'),
            'canLogin' => !$isAdminRoute ? Route::has('login') : false,
            'canRegister' => !$isAdminRoute ? Route::has('register') : false,
            'displayScrollUp' => !$frontPage,
            'ziggy' => function () use ($request) {
                return array_merge((new Ziggy)->toArray(), [
                    'location' => $request->url(),
                ]);
            },
        ]);
    }
}
