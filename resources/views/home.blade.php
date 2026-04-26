@extends('layout')

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
        <a href="https://github.com" target="_blank"
           class="px-6 py-3 border border-gray-600 rounded hover:bg-gray-800 transition">
            GitHub ↗
        </a>
    </div>

</div>

@endsection
