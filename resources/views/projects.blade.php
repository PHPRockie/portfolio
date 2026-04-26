@extends('layout')

@section('content')

<div class="max-w-5xl mx-auto">

    <h1 class="text-3xl font-bold mb-10">Projects</h1>

    <div class="grid md:grid-cols-2 gap-8">

        <!-- Project 1 -->
        <div class="bg-gray-800 rounded-lg p-6 hover:scale-105 transition">
            <h2 class="text-xl font-semibold mb-2">Check-In App</h2>

            <p class="text-gray-400 mb-4">
                Laravel attendance system for gymnastics classes with check-in / check-out,
                roles, and reporting.
            </p>

            <span class="text-sm bg-blue-600 px-3 py-1 rounded">Laravel</span>
        </div>

        <!-- Project 2 -->
        <div class="bg-gray-800 rounded-lg p-6 hover:scale-105 transition">
            <h2 class="text-xl font-semibold mb-2">Gymnastics Tracker</h2>

            <p class="text-gray-400 mb-4">
                Training logger for athletes — sessions, notes, goals, and progress tracking.
            </p>

            <span class="text-sm bg-green-600 px-3 py-1 rounded">PHP</span>
        </div>

        <!-- Project 3 -->
        <div class="bg-gray-800 rounded-lg p-6 hover:scale-105 transition">
            <h2 class="text-xl font-semibold mb-2">Personal Portfolio</h2>

            <p class="text-gray-400 mb-4">
                This website. Built with Laravel + Tailwind to showcase projects and experience.
            </p>

            <span class="text-sm bg-purple-600 px-3 py-1 rounded">Tailwind</span>
        </div>

    </div>

</div>

@endsection
