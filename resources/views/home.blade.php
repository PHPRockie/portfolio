@extends('layout')

@section('content')

<div class="grid md:grid-cols-2 gap-12 items-center">

    {{-- Left --}}
    <div>
        <h1 class="text-4xl md:text-5xl font-bold mb-4">
            Hi, I'm PHP Rockie 👋
        </h1>

        <p class="text-lg text-gray-400 mb-6">
            Gymnastics Coach & Laravel Developer
        </p>

        <p class="mb-8">
            I build tools for gymnastics training and modern web applications.
        </p>

        <div class="space-x-4">
            <a href="/projects"
               class="px-6 py-3 bg-blue-600 hover:bg-blue-700 rounded text-white transition">
                View Projects
            </a>

            <a href="/contact"
               class="px-6 py-3 border border-gray-600 rounded hover:bg-gray-800 transition">
                Contact Me
            </a>
        </div>
    </div>

    {{-- Right --}}
    <div class="bg-gray-800 rounded-xl p-6 shadow">

        <h2 class="text-xl font-semibold mb-4">Featured Projects</h2>

        <div class="space-y-4">

            <div class="p-4 bg-gray-900 rounded">
                <h3 class="font-bold">Check-In App</h3>
                <p class="text-sm text-gray-400">
                    Laravel attendance tracker for gymnastics classes.
                </p>
            </div>

            <div class="p-4 bg-gray-900 rounded">
                <h3 class="font-bold">Gymnastics Tracker</h3>
                <p class="text-sm text-gray-400">
                    Web app for logging daily training sessions.
                </p>
            </div>

        </div>

    </div>

</div>

@endsection
