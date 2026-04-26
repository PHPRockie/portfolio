@extends('layout')

@section('content')

<div class="max-w-5xl mx-auto">

    <h1 class="text-3xl font-bold mb-10">Projects</h1>

    <div class="grid md:grid-cols-2 gap-8">

        @foreach ($projects as $project)
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
        <div class="bg-gray-800 rounded-lg p-6 hover:scale-105 transition flex flex-col justify-between">
            <div>
                <h2 class="text-xl font-semibold mb-2">{{ $project->title }}</h2>
                <p class="text-gray-400 mb-4">{{ $project->summary }}</p>
                <div class="flex flex-wrap gap-2 mb-4">
                    @foreach ($project->tech_stack as $tag)
                        <span class="text-sm {{ $tagColors[$tag] ?? 'bg-gray-600' }} px-3 py-1 rounded">
                            {{ $tag }}
                        </span>
                    @endforeach
                </div>
            </div>
            <div class="flex gap-3 mt-2">
                @if ($project->github_url)
                    <a href="{{ $project->github_url }}" target="_blank"
                       class="text-sm text-blue-400 border border-blue-800 px-3 py-1 rounded hover:bg-blue-900 transition">
                        GitHub ↗
                    </a>
                @endif
                <a href="/projects/{{ $project->slug }}"
                   class="text-sm text-gray-300 border border-gray-600 px-3 py-1 rounded hover:bg-gray-700 transition">
                    Details →
                </a>
            </div>
        </div>
        @endforeach

    </div>

</div>

@endsection
