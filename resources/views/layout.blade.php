<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Jose Portfolio</title>

    {{-- Google Font --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    {{-- Vite (SIEMPRE al final del head) --}}
    @vite(['resources/js/app.js', 'resources/css/app.css'])
</head>

<body class="bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-gray-100 min-h-screen">

<header class="sticky top-0 z-50 bg-gray-900 border-b border-gray-800">
    <nav class="max-w-6xl mx-auto flex justify-between items-center px-6 py-4">

        <a href="/" class="text-xl font-bold">PHP Rockie</a>

        <div class="space-x-6">
            <a href="/" class="hover:text-blue-400 transition">Home</a>
            <a href="/about" class="hover:text-blue-400 transition">About</a>
            <a href="/projects" class="hover:text-blue-400 transition">Projects</a>
            <a href="/contact" class="hover:text-blue-400 transition">Contact</a>
        </div>

    </nav>
</header>

<main class="max-w-6xl mx-auto px-6 py-16 fade-in">
    @yield('content')
</main>

<footer class="border-t border-gray-800 mt-20">
    <div class="max-w-6xl mx-auto text-center py-8 text-gray-500">
        © {{ date('Y') }} PHP Rockie — Built with Laravel & Tailwind
    </div>
</footer>

</body>
</html>
