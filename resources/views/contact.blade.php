@extends('layout')

@section('title', 'Contact')

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
            <label for="name" class="block text-sm mb-1">Name</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" required
                class="w-full rounded bg-gray-900 border px-3 py-2 focus:outline-none focus:border-blue-500 @error('name') border-red-500 @else border-gray-700 @enderror">
            @error('name')
                <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="email" class="block text-sm mb-1">Email</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required
                class="w-full rounded bg-gray-900 border px-3 py-2 focus:outline-none focus:border-blue-500 @error('email') border-red-500 @else border-gray-700 @enderror">
            @error('email')
                <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="message" class="block text-sm mb-1">Message</label>
            <textarea id="message" name="message" rows="4" required
                class="w-full rounded bg-gray-900 border px-3 py-2 focus:outline-none focus:border-blue-500 @error('message') border-red-500 @else border-gray-700 @enderror">{{ old('message') }}</textarea>
            @error('message')
                <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit"
            class="bg-blue-600 hover:bg-blue-700 transition px-6 py-2 rounded font-semibold">
            Send Message
        </button>

    </form>

</div>

@endsection
