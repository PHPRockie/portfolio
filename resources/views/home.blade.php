@extends('layout')

@section('title', 'Jose C Garcia')

@section('content')

<div class="max-w-2xl">

    <p class="text-sm font-semibold tracking-widest text-blue-400 uppercase mb-4">
        Laravel · PHP · Full-Stack
    </p>

    <h1 class="text-4xl md:text-5xl font-bold mb-6 leading-tight">
        Backend Developer<br>building real tools.
    </h1>

    <p class="text-lg text-gray-400 mb-10">
        I build Laravel applications focused on real workflows — attendance systems,
        training trackers, and custom web tools that get used every day.
    </p>

    <div class="flex flex-wrap gap-4">
        <a href="{{ route('projects.index') }}"
           class="px-6 py-3 bg-blue-600 hover:bg-blue-700 rounded text-white font-semibold transition">
            View Projects
        </a>
        <a href="https://github.com/PHPRockie" target="_blank"
           class="px-6 py-3 border border-gray-600 rounded hover:bg-gray-800 transition">
            GitHub ↗
        </a>
        <a href="https://www.linkedin.com/in/jose-garcia-2b9142407" target="_blank"
           class="px-6 py-3 border border-gray-600 rounded hover:bg-gray-800 transition">
            LinkedIn ↗
        </a>
    </div>

</div>

{{-- Featured Projects --}}
@if ($featured->isNotEmpty())
<div class="mt-24">
    <div class="flex justify-between items-baseline mb-8">
        <h2 class="text-2xl font-bold">Featured Projects</h2>
        <a href="{{ route('projects.index') }}" class="text-sm text-blue-400 hover:underline">View all →</a>
    </div>

    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($featured as $project)
        <a href="{{ route('projects.show', $project->slug) }}"
           class="bg-gray-800 rounded-lg p-6 flex flex-col justify-between hover:bg-gray-750 hover:ring-1 hover:ring-gray-600 transition group">
            <div>
                <h3 class="text-lg font-semibold mb-2 group-hover:text-blue-400 transition">{{ $project->title }}</h3>
                <p class="text-gray-400 text-sm mb-4">{{ $project->summary }}</p>
                <div class="flex flex-wrap gap-2">
                    @foreach (array_slice($project->tech_stack, 0, 3) as $tag)
                        <span class="text-xs {{ $tagColors[$tag] ?? 'bg-gray-600' }} px-2 py-0.5 rounded">{{ $tag }}</span>
                    @endforeach
                </div>
            </div>
            <div class="mt-4 flex items-center justify-between">
                <span class="text-xs text-gray-500">
                    @if ($project->github_private)
                        Private
                    @else
                        Open Source
                    @endif
                </span>
                <span class="text-blue-400 text-sm group-hover:translate-x-1 transition-transform inline-block">→</span>
            </div>
        </a>
        @endforeach
    </div>
</div>
@endif

@endsection
