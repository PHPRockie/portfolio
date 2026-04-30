<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void {}

    public function boot(): void
    {
        View::share('tagColors', [
            'Laravel'      => 'bg-blue-600',
            'PHP'          => 'bg-blue-600',
            'MySQL'        => 'bg-green-600',
            'SQLite'       => 'bg-green-600',
            'Tailwind CSS' => 'bg-purple-600',
            'JavaScript'   => 'bg-yellow-500 text-gray-900',
            'TypeScript'   => 'bg-blue-500',
            'React'        => 'bg-cyan-600',
            'Vite'         => 'bg-orange-500',
            'Blade'        => 'bg-red-700',
            'Supabase'     => 'bg-emerald-600',
            'HTML'         => 'bg-orange-600',
            'CSS'          => 'bg-sky-600',
        ]);
    }
}
