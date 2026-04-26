@extends('layout')

@section('content')

<div class="max-w-5xl mx-auto">

    <h1 class="text-3xl font-bold mb-10">About Me</h1>

    <div class="grid md:grid-cols-2 gap-12">

        {{-- Left: bio + timeline --}}
        <div>
            <p class="text-gray-300 mb-8 leading-relaxed">
                I'm a Laravel developer with a background in gymnastics coaching.
                That background shapes how I build software — I care about tools that work
                under pressure, workflows that make sense to real people, and systems
                that don't break when it matters most.
            </p>

            <h2 class="text-lg font-semibold mb-4">Experience</h2>

            <div class="flex flex-col gap-6">

                <div class="flex gap-4">
                    <div class="flex flex-col items-center">
                        <div class="w-3 h-3 rounded-full bg-blue-500 mt-1 flex-shrink-0"></div>
                        <div class="w-px flex-1 bg-gray-700 mt-1"></div>
                    </div>
                    <div class="pb-6">
                        <div class="font-semibold text-white">Laravel Developer</div>
                        <div class="text-sm text-gray-500 mb-1">2023 – Present · Freelance</div>
                        <div class="text-sm text-gray-400">
                            Built Check-In App and Gymnastics Tracker — practical tools
                            solving real problems in the coaching world.
                        </div>
                    </div>
                </div>

                <div class="flex gap-4">
                    <div class="flex flex-col items-center">
                        <div class="w-3 h-3 rounded-full bg-gray-600 mt-1 flex-shrink-0"></div>
                    </div>
                    <div>
                        <div class="font-semibold text-white">Gymnastics Coach</div>
                        <div class="text-sm text-gray-500 mb-1">2018 – Present</div>
                        <div class="text-sm text-gray-400">
                            Coached athletes at all levels. Started building web tools
                            to solve the operational problems I saw every day.
                        </div>
                    </div>
                </div>

            </div>
        </div>

        {{-- Right: stack + resume --}}
        <div>
            <h2 class="text-lg font-semibold mb-4">Stack</h2>

            <div class="grid grid-cols-2 gap-3 mb-8">
                @foreach (['Laravel', 'PHP 8', 'MySQL', 'SQLite', 'Tailwind CSS', 'Blade', 'JavaScript', 'Vite'] as $tech)
                    <div class="bg-gray-800 px-4 py-3 rounded text-sm text-gray-300">
                        {{ $tech }}
                    </div>
                @endforeach
            </div>

            <h2 class="text-lg font-semibold mb-4">Resume</h2>
            <a href="/resume.pdf" download
               class="inline-block bg-gray-800 hover:bg-gray-700 transition px-5 py-2 rounded text-sm text-gray-300">
                Download PDF ↓
            </a>
        </div>

    </div>

</div>

@endsection
