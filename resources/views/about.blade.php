@extends('layout')

@section('content')

<div class="max-w-4xl mx-auto">

    <h1 class="text-3xl font-bold mb-6">About Me</h1>

    <p class="text-gray-400 mb-8">
        I'm PHP Rockie — gymnastics coach and Laravel developer. I build web tools focused on performance,
        training efficiency, and real-world workflows.
    </p>

    <h2 class="text-xl font-semibold mb-4">Skills</h2>

    <div class="grid grid-cols-2 md:grid-cols-3 gap-4">

        <div class="bg-gray-800 p-4 rounded">Laravel</div>
        <div class="bg-gray-800 p-4 rounded">PHP</div>
        <div class="bg-gray-800 p-4 rounded">Tailwind CSS</div>
        <div class="bg-gray-800 p-4 rounded">MySQL / SQLite</div>
        <div class="bg-gray-800 p-4 rounded">JavaScript</div>
        <div class="bg-gray-800 p-4 rounded">Gymnastics Coaching</div>

    </div>

</div>

@endsection
