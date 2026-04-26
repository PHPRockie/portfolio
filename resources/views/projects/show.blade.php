@extends('layout')

@section('content')

<div class="max-w-5xl mx-auto">

    <a href="/projects" class="text-blue-400 hover:underline text-sm mb-8 inline-block">
        ← Projects
    </a>

    @php
        $tagColors = [
            'Laravel'      => 'bg-blue-600',
            'PHP'          => 'bg-blue-600',
            'MySQL'        => 'bg-green-600',
            'SQLite'       => 'bg-green-600',
            'Tailwind CSS' => 'bg-purple-600',
            'JavaScript'   => 'bg-yellow-600',
            'Vite'         => 'bg-orange-600',
            'Blade'        => 'bg-red-700',
        ];
    @endphp

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

            @if ($project->github_url)
            <a href="{{ $project->github_url }}" target="_blank"
               class="inline-block bg-blue-600 hover:bg-blue-700 transition px-6 py-2 rounded font-semibold">
                View on GitHub ↗
            </a>
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
