@extends('layout')

@section('content')

<div class="max-w-xl mx-auto">

    <h1 class="text-3xl font-bold mb-6">Contact Me</h1>

    @if(session('success'))
        <div class="bg-green-600/20 border border-green-500 text-green-300 px-4 py-3 rounded mb-6">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('contact.send') }}" class="bg-gray-800 p-6 rounded-lg space-y-4">

        @csrf

        <div>
            <label class="block text-sm mb-1">Name</label>
            <input type="text" name="name" required
                class="w-full rounded bg-gray-900 border border-gray-700 px-3 py-2 focus:outline-none focus:border-blue-500">
        </div>

        <div>
            <label class="block text-sm mb-1">Email</label>
            <input type="email" name="email" required
                class="w-full rounded bg-gray-900 border border-gray-700 px-3 py-2 focus:outline-none focus:border-blue-500">
        </div>

        <div>
            <label class="block text-sm mb-1">Message</label>
            <textarea name="message" rows="4" required
                class="w-full rounded bg-gray-900 border border-gray-700 px-3 py-2 focus:outline-none focus:border-blue-500"></textarea>
        </div>

        <button type="submit"
            class="bg-blue-600 hover:bg-blue-700 transition px-6 py-2 rounded font-semibold">
            Send Message
        </button>

    </form>

</div>

@endsection


