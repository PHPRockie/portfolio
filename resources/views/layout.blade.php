<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Jose C Garcia') — Laravel Developer</title>

    {{-- Google Font --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/js/app.js', 'resources/css/app.css'])
</head>

<body class="bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-gray-100 min-h-screen">

<header class="sticky top-0 z-50 bg-gray-900 border-b border-gray-800">
    <nav class="max-w-6xl mx-auto px-6 py-4">
        <div class="flex justify-between items-center">

            <a href="{{ route('home') }}" class="text-xl font-bold">Jose C Garcia</a>

            {{-- Desktop nav --}}
            <div class="hidden md:flex space-x-6">
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

            {{-- Hamburger button (mobile) --}}
            <button id="nav-toggle" class="md:hidden text-gray-300 hover:text-white focus:outline-none" aria-label="Toggle menu">
                <svg id="icon-open" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
                <svg id="icon-close" class="w-6 h-6 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>

        </div>

        {{-- Mobile menu --}}
        <div id="mobile-menu" class="hidden md:hidden pt-4 pb-2 flex flex-col gap-3">
            <a href="{{ route('home') }}"
               class="transition hover:text-blue-400 {{ request()->is('/') || request()->is('') ? 'text-blue-400' : 'text-gray-300' }}">
                Home
            </a>
            <a href="{{ route('about') }}"
               class="transition hover:text-blue-400 {{ request()->is('about') ? 'text-blue-400' : 'text-gray-300' }}">
                About
            </a>
            <a href="{{ route('projects.index') }}"
               class="transition hover:text-blue-400 {{ request()->is('projects*') ? 'text-blue-400' : 'text-gray-300' }}">
                Projects
            </a>
            <a href="{{ route('contact') }}"
               class="transition hover:text-blue-400 {{ request()->is('contact') ? 'text-blue-400' : 'text-gray-300' }}">
                Contact
            </a>
        </div>

    </nav>
</header>

<script>
    const toggle = document.getElementById('nav-toggle');
    const menu = document.getElementById('mobile-menu');
    const iconOpen = document.getElementById('icon-open');
    const iconClose = document.getElementById('icon-close');
    toggle.addEventListener('click', () => {
        menu.classList.toggle('hidden');
        iconOpen.classList.toggle('hidden');
        iconClose.classList.toggle('hidden');
    });
</script>

<main class="max-w-6xl mx-auto px-6 py-16 fade-in">
    @yield('content')
</main>

<footer class="border-t border-gray-800 mt-20">
    <div class="max-w-6xl mx-auto py-8 px-6 flex flex-col md:flex-row justify-between items-center gap-4 text-gray-500 text-sm">
        <span>© {{ date('Y') }} Jose C Garcia — Built with Laravel & Tailwind</span>
        <div class="flex gap-5">
            <a href="https://github.com/PHPRockie" target="_blank" class="hover:text-gray-300 transition">GitHub</a>
            <a href="https://www.linkedin.com/in/jose-garcia-2b9142407" target="_blank" class="hover:text-gray-300 transition">LinkedIn</a>
        </div>
    </div>
</footer>

</body>
</html>
