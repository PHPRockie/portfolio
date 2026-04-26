<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Jose C Garcia — Laravel Developer</title>

    {{-- Google Font --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/js/app.js', 'resources/css/app.css'])
</head>

<body class="bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-gray-100 min-h-screen">

<header class="sticky top-0 z-50 bg-gray-900 border-b border-gray-800">
    <nav class="max-w-6xl mx-auto flex justify-between items-center px-6 py-4">

        <a href="{{ route('home') }}" class="text-xl font-bold">Jose C Garcia</a>

        <div class="space-x-6">
            <a href="{{ route('home') }}"
               class="transition hover:text-blue-400 {{ request()->is('/') || request()->is('') ? 'text-blue-400 border-b border-blue-400 pb-0.5' : 'text-gray-300' }}">
                Home
            </a>
            <a href="{{ route('about') }}"
               class="transition hover:text-blue-400 {{ request()->is('about') ? 'text-blue-400 border-b border-blue-400 pb-0.5' : 'text-gray-300' }}">
                About
            </a>
            <a href="{{ route('projects.index') }}"
               class="transition hover:text-blue-400 {{ request()->is('projects*') ? 'text-blue-400 border-b border-blue-400 pb-0.5' : 'text-gray-300' }}">
                Projects
            </a>
            <a href="{{ route('contact') }}"
               class="transition hover:text-blue-400 {{ request()->is('contact') ? 'text-blue-400 border-b border-blue-400 pb-0.5' : 'text-gray-300' }}">
                Contact
            </a>
        </div>

    </nav>
</header>

<main class="max-w-6xl mx-auto px-6 py-16 fade-in">
    @yield('content')
</main>

<footer class="border-t border-gray-800 mt-20">
    <div class="max-w-6xl mx-auto text-center py-8 text-gray-500">
        © {{ date('Y') }} Jose C Garcia — Built with Laravel & Tailwind
    </div>
</footer>

</body>
</html>
