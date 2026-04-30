@extends('layout')

@section('title', $project->title)

@section('content')

<div class="max-w-5xl mx-auto">

    <a href="{{ route('projects.index') }}" class="text-blue-400 hover:underline text-sm mb-8 inline-block">
        ← Projects
    </a>

    <div class="grid md:grid-cols-3 gap-10">

        {{-- Left: main content --}}
        <div class="md:col-span-2">

            <h1 class="text-3xl font-bold mb-4">{{ $project->title }}</h1>

            <div class="flex flex-wrap gap-2 mb-6">
                @foreach ($project->tech_stack as $tag)
                    <span class="text-sm {{ $tagColors[$tag] ?? 'bg-gray-600' }} px-3 py-1 rounded">
                        {{ $tag }}
                    </span>
                @endforeach
            </div>

            <p class="text-gray-300 mb-8">{{ $project->description }}</p>

            @if ($project->problem)
            <div class="mb-6">
                <h2 class="text-lg font-semibold mb-2 text-white">The Problem</h2>
                <p class="text-gray-400">{{ $project->problem }}</p>
            </div>
            @endif

            @if ($project->solution)
            <div class="mb-8">
                <h2 class="text-lg font-semibold mb-2 text-white">The Solution</h2>
                <p class="text-gray-400">{{ $project->solution }}</p>
            </div>
            @endif

            @if ($project->github_url && !$project->github_private)
            <a href="{{ $project->github_url }}" target="_blank"
               class="inline-block bg-blue-600 hover:bg-blue-700 transition px-6 py-2 rounded font-semibold">
                View on GitHub ↗
            </a>
            @elseif ($project->github_private)
            <span class="inline-flex items-center gap-2 border border-gray-700 text-gray-500 px-6 py-2 rounded text-sm">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"/></svg>
                Private Repository
            </span>
            @endif

        </div>

        {{-- Right: sidebar --}}
        <div class="flex flex-col gap-6">

            <div class="bg-gray-800 rounded-lg p-5">
                <h3 class="text-sm font-semibold uppercase tracking-wider text-gray-400 mb-3">Stack</h3>
                <ul class="space-y-1">
                    @foreach ($project->tech_stack as $tech)
                        <li class="text-gray-300 text-sm">{{ $tech }}</li>
                    @endforeach
                </ul>
            </div>

            @if ($project->highlights)
            <div class="bg-gray-800 rounded-lg p-5">
                <h3 class="text-sm font-semibold uppercase tracking-wider text-gray-400 mb-3">Highlights</h3>
                <ul class="space-y-2">
                    @foreach ($project->highlights as $highlight)
                        <li class="text-gray-300 text-sm flex gap-2">
                            <span class="text-blue-400 mt-0.5">→</span>
                            <span>{{ $highlight }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
            @endif

        </div>

    </div>

</div>

@endsection
