# Portfolio Upgrade Implementation Plan

> **For agentic workers:** REQUIRED SUB-SKILL: Use superpowers:subagent-driven-development (recommended) or superpowers:executing-plans to implement this plan task-by-task. Steps use checkbox (`- [ ]`) syntax for tracking.

**Goal:** Upgrade the Laravel portfolio with data-driven projects, a project detail page, redesigned home/about pages, contact form validation errors, and active nav states — targeting employer/recruiter audiences.

**Architecture:** Projects move from hardcoded Blade to an Eloquent `Project` model backed by a `projects` table with JSON fields for tech stack and highlights. A new `/projects/{slug}` route serves detail pages. All other changes are Blade/CSS only — no new packages.

**Tech Stack:** Laravel 11, PHP 8.3, Eloquent, Blade, Tailwind CSS v3, Vite

---

## File Map

| Action | File | Responsibility |
|--------|------|----------------|
| Create | `database/migrations/xxxx_create_projects_table.php` | projects schema |
| Create | `app/Models/Project.php` | Eloquent model with JSON casts |
| Create | `database/seeders/ProjectSeeder.php` | seeds 3 projects |
| Create | `resources/views/projects/index.blade.php` | data-driven cards grid |
| Create | `resources/views/projects/show.blade.php` | detail page: problem/solution/stack |
| Modify | `app/Http/Controllers/PageController.php` | pass Project data, add show() |
| Modify | `routes/web.php` | add /projects/{slug} route |
| Modify | `resources/views/home.blade.php` | single-column hero |
| Modify | `resources/views/about.blade.php` | two-column: timeline + stack |
| Modify | `resources/views/contact.blade.php` | @error + old() |
| Modify | `resources/views/layout.blade.php` | active nav, name |
| Modify | `database/seeders/DatabaseSeeder.php` | call ProjectSeeder |
| Modify | `.gitignore` | add .superpowers/ |

---

## Task 1: Projects Table — Migration, Model, Seeder

**Files:**
- Create: `database/migrations/2026_04_25_000001_create_projects_table.php`
- Create: `app/Models/Project.php`
- Create: `database/seeders/ProjectSeeder.php`
- Modify: `database/seeders/DatabaseSeeder.php`

- [ ] **Step 1: Create the migration**

Create `database/migrations/2026_04_25_000001_create_projects_table.php`:

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('summary');
            $table->text('description');
            $table->json('tech_stack');
            $table->string('github_url')->nullable();
            $table->string('live_url')->nullable();
            $table->boolean('featured')->default(false);
            $table->text('problem')->nullable();
            $table->text('solution')->nullable();
            $table->json('highlights')->nullable();
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
```

- [ ] **Step 2: Create the Project model**

Create `app/Models/Project.php`:

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'title', 'slug', 'summary', 'description',
        'tech_stack', 'github_url', 'live_url',
        'featured', 'problem', 'solution', 'highlights', 'sort_order',
    ];

    protected $casts = [
        'tech_stack' => 'array',
        'highlights' => 'array',
        'featured' => 'boolean',
    ];
}
```

- [ ] **Step 3: Create the seeder**

Create `database/seeders/ProjectSeeder.php`:

```php
<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        Project::truncate();

        Project::create([
            'title' => 'Check-In App',
            'slug' => 'check-in-app',
            'summary' => 'Attendance management system for gymnastics classes.',
            'description' => 'A Laravel web application built for a gymnastics gym to replace paper-based attendance tracking. Coaches check athletes in and out of classes, admins view daily reports, and the owner gets monthly summaries.',
            'tech_stack' => ['Laravel', 'MySQL', 'Tailwind CSS'],
            'github_url' => '',
            'live_url' => '',
            'featured' => true,
            'problem' => 'Coaches were tracking attendance on paper. Records got lost between sessions, and generating monthly reports took hours of manual work.',
            'solution' => 'Built a role-based Laravel app where coaches check athletes in via a simple UI, data is stored instantly, and admins can export CSV reports with one click.',
            'highlights' => [
                'Role-based access: admin, coach, viewer',
                'Real-time check-in / check-out with timestamps',
                'Daily and monthly attendance reports',
                'CSV export for record-keeping',
            ],
            'sort_order' => 1,
        ]);

        Project::create([
            'title' => 'Gymnastics Tracker',
            'slug' => 'gymnastics-tracker',
            'summary' => 'Training logger for athletes — sessions, goals, and progress.',
            'description' => 'A PHP application for logging daily gymnastics training sessions. Athletes record what they trained, set goals, and track progress over time. Coaches can review their athletes\' logs.',
            'tech_stack' => ['PHP', 'SQLite'],
            'github_url' => '',
            'live_url' => '',
            'featured' => true,
            'problem' => 'Athletes had no structured way to log training sessions or track progress toward goals across weeks and months.',
            'solution' => 'Built a lightweight PHP app backed by SQLite where athletes log sessions daily and coaches can review progress without needing a heavy setup.',
            'highlights' => [
                'Daily session logging with notes',
                'Goal setting and progress tracking',
                'Coach review dashboard',
                'Zero-config SQLite backend',
            ],
            'sort_order' => 2,
        ]);

        Project::create([
            'title' => 'Portfolio',
            'slug' => 'portfolio',
            'summary' => 'This website — built with Laravel, Tailwind, and Vite.',
            'description' => 'The portfolio you\'re looking at right now. Built to demonstrate full-stack Laravel development: migrations, Eloquent models, Blade templates, Tailwind CSS, and Vite asset bundling.',
            'tech_stack' => ['Laravel', 'Tailwind CSS', 'Vite'],
            'github_url' => '',
            'live_url' => '',
            'featured' => false,
            'problem' => 'Needed a portfolio that itself demonstrates Laravel skills, not just describes them.',
            'solution' => 'Built the portfolio using the same stack I use professionally — data-driven project pages, proper routing, and a clean dark UI.',
            'highlights' => [
                'Data-driven project pages (Eloquent + migrations)',
                'Contact form with validation and DB storage',
                'Tailwind CSS dark theme',
                'Vite asset bundling',
            ],
            'sort_order' => 3,
        ]);
    }
}
```

- [ ] **Step 4: Register the seeder in DatabaseSeeder**

Open `database/seeders/DatabaseSeeder.php`. Add the call inside `run()`:

```php
public function run(): void
{
    $this->call([
        ProjectSeeder::class,
    ]);
}
```

- [ ] **Step 5: Run the migration and seed**

```bash
php artisan migrate
php artisan db:seed --class=ProjectSeeder
```

Expected output: `Seeding: Database\Seeders\ProjectSeeder` then `Database seeding completed successfully.`

- [ ] **Step 6: Verify in Tinker**

```bash
php artisan tinker
>>> App\Models\Project::count()   # should return 3
>>> App\Models\Project::first()->tech_stack  # should return array
>>> exit
```

- [ ] **Step 7: Commit**

```bash
git add database/migrations/2026_04_25_000001_create_projects_table.php \
        app/Models/Project.php \
        database/seeders/ProjectSeeder.php \
        database/seeders/DatabaseSeeder.php
git commit -m "feat: add Project model, migration, and seeder"
```

---

## Task 2: Projects Index Page (Data-Driven Cards)

**Files:**
- Create: `resources/views/projects/index.blade.php`
- Modify: `app/Http/Controllers/PageController.php`
- Delete: `resources/views/projects.blade.php` (replaced by the directory version)

- [ ] **Step 1: Create the projects directory and index view**

Create `resources/views/projects/index.blade.php`:

```blade
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
```

- [ ] **Step 2: Update PageController to pass projects data and use new view name**

Open `app/Http/Controllers/PageController.php`. Replace the `projects()` method:

```php
public function projects()
{
    $projects = \App\Models\Project::orderBy('sort_order')->get();
    return view('projects.index', compact('projects'));
}
```

- [ ] **Step 3: Delete the old flat projects view**

```bash
rm resources/views/projects.blade.php
```

- [ ] **Step 4: Verify in browser**

```bash
php artisan serve
```

Open `http://localhost:8000/projects`. You should see 3 cards: Check-In App, Gymnastics Tracker, Portfolio — each with tech badge pills and a "Details →" link.

- [ ] **Step 5: Commit**

```bash
git add resources/views/projects/ \
        app/Http/Controllers/PageController.php
git rm resources/views/projects.blade.php
git commit -m "feat: replace hardcoded projects with data-driven Eloquent cards"
```

---

## Task 3: Project Detail Page

**Files:**
- Create: `resources/views/projects/show.blade.php`
- Modify: `app/Http/Controllers/PageController.php` (add `show()`)
- Modify: `routes/web.php` (add `/projects/{slug}`)

- [ ] **Step 1: Create the detail view**

Create `resources/views/projects/show.blade.php`:

```blade
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
```

- [ ] **Step 2: Add the `show()` method to PageController**

Open `app/Http/Controllers/PageController.php`. Add this method inside the class:

```php
public function show(string $slug)
{
    $project = \App\Models\Project::where('slug', $slug)->firstOrFail();
    return view('projects.show', compact('project'));
}
```

`firstOrFail()` automatically returns a 404 response if no project matches the slug.

- [ ] **Step 3: Add the route**

Open `routes/web.php`. Add after the existing `/projects` GET route:

```php
Route::get('/projects/{slug}', [PageController::class, 'show'])->name('projects.show');
```

Full `routes/web.php` should now look like:

```php
<?php

use App\Http\Controllers\PageController;

Route::get('/', [PageController::class, 'home']);
Route::get('/about', [PageController::class, 'about']);
Route::get('/projects', [PageController::class, 'projects']);
Route::get('/projects/{slug}', [PageController::class, 'show'])->name('projects.show');

Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::post('/contact', [PageController::class, 'send'])->name('contact.send');
```

- [ ] **Step 4: Verify in browser**

Open `http://localhost:8000/projects` and click "Details →" on Check-In App.
Expected: two-column page with problem, solution, stack sidebar, and highlights.
Try `http://localhost:8000/projects/nonexistent` — expected: 404 page.

- [ ] **Step 5: Commit**

```bash
git add resources/views/projects/show.blade.php \
        app/Http/Controllers/PageController.php \
        routes/web.php
git commit -m "feat: add project detail page with problem/solution narrative"
```

---

## Task 4: Home Page Hero Redesign

**Files:**
- Modify: `resources/views/home.blade.php`

- [ ] **Step 1: Replace home.blade.php**

Replace the entire contents of `resources/views/home.blade.php`:

```blade
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
        <a href="/projects"
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
```

> **Note:** Replace `https://github.com` with your actual GitHub profile URL.

- [ ] **Step 2: Verify in browser**

Open `http://localhost:8000`. Expected: single-column hero with blue tech label, bold headline, pitch, and two buttons. No sidebar project panel.

- [ ] **Step 3: Commit**

```bash
git add resources/views/home.blade.php
git commit -m "feat: redesign home hero — single column, focused developer pitch"
```

---

## Task 5: About Page Redesign

**Files:**
- Modify: `resources/views/about.blade.php`

- [ ] **Step 1: Replace about.blade.php**

Replace the entire contents of `resources/views/about.blade.php`:

```blade
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
```

- [ ] **Step 2: Verify in browser**

Open `http://localhost:8000/about`. Expected: two-column layout with bio + timeline on left, stack grid + resume button on right. Timeline shows two entries with the blue dot connector. Stack grid shows 8 items in 2 columns.

- [ ] **Step 3: Commit**

```bash
git add resources/views/about.blade.php
git commit -m "feat: redesign about page with experience timeline and stack grid"
```

---

## Task 6: Contact Form — Inline Validation Errors

**Files:**
- Modify: `resources/views/contact.blade.php`

- [ ] **Step 1: Add @error directives and old() helpers**

Replace the entire contents of `resources/views/contact.blade.php`:

```blade
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
            <input type="text" name="name" value="{{ old('name') }}" required
                class="w-full rounded bg-gray-900 border border-gray-700 px-3 py-2 focus:outline-none focus:border-blue-500
                       @error('name') border-red-500 @enderror">
            @error('name')
                <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-sm mb-1">Email</label>
            <input type="email" name="email" value="{{ old('email') }}" required
                class="w-full rounded bg-gray-900 border border-gray-700 px-3 py-2 focus:outline-none focus:border-blue-500
                       @error('email') border-red-500 @enderror">
            @error('email')
                <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-sm mb-1">Message</label>
            <textarea name="message" rows="4" required
                class="w-full rounded bg-gray-900 border border-gray-700 px-3 py-2 focus:outline-none focus:border-blue-500
                       @error('message') border-red-500 @enderror">{{ old('message') }}</textarea>
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
```

- [ ] **Step 2: Verify in browser**

Open `http://localhost:8000/contact`. Submit the form empty (remove `required` from browser devtools or use a short name). Expected: form reloads with red border on invalid fields and error messages below each field. Valid values you typed are preserved.

- [ ] **Step 3: Commit**

```bash
git add resources/views/contact.blade.php
git commit -m "fix: show inline validation errors and preserve input on contact form"
```

---

## Task 7: Global Layout — Active Nav, Name, .gitignore

**Files:**
- Modify: `resources/views/layout.blade.php`
- Modify: `.gitignore`

- [ ] **Step 1: Update layout.blade.php — active nav and name**

Replace the entire contents of `resources/views/layout.blade.php`:

```blade
<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Jose C Garcia — Laravel Developer</title>

    {{-- Google Font --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/js/app.js', 'resources/css/app.css'])
</head>

<body class="bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-gray-100 min-h-screen">

<header class="sticky top-0 z-50 bg-gray-900 border-b border-gray-800">
    <nav class="max-w-6xl mx-auto flex justify-between items-center px-6 py-4">

        <a href="/" class="text-xl font-bold">Jose C Garcia</a>

        <div class="space-x-6">
            <a href="/"
               class="transition hover:text-blue-400 {{ request()->is('/') || request()->is('') ? 'text-blue-400 border-b border-blue-400 pb-0.5' : 'text-gray-300' }}">
                Home
            </a>
            <a href="/about"
               class="transition hover:text-blue-400 {{ request()->is('about') ? 'text-blue-400 border-b border-blue-400 pb-0.5' : 'text-gray-300' }}">
                About
            </a>
            <a href="/projects"
               class="transition hover:text-blue-400 {{ request()->is('projects*') ? 'text-blue-400 border-b border-blue-400 pb-0.5' : 'text-gray-300' }}">
                Projects
            </a>
            <a href="/contact"
               class="transition hover:text-blue-400 {{ request()->is('contact') ? 'text-blue-400 border-b border-blue-400 pb-0.5' : 'text-gray-300' }}">
                Contact
            </a>
        </div>

    </nav>
</header>

<main class="max-w-6xl mx-auto px-6 py-16 fade-in">
    @yield('content')
</main>

<footer class="border-t border-gray-800 mt-20">
    <div class="max-w-6xl mx-auto text-center py-8 text-gray-500">
        © {{ date('Y') }} Jose C Garcia — Built with Laravel & Tailwind
    </div>
</footer>

</body>
</html>
```

- [ ] **Step 2: Add .superpowers/ to .gitignore**

Open `.gitignore` and add this line at the bottom:

```
.superpowers/
```

- [ ] **Step 3: Verify active nav in browser**

Visit each page and confirm the correct nav link turns blue with an underline:
- `http://localhost:8000/` → Home highlighted
- `http://localhost:8000/about` → About highlighted
- `http://localhost:8000/projects` → Projects highlighted
- `http://localhost:8000/projects/check-in-app` → Projects highlighted (uses `projects*`)
- `http://localhost:8000/contact` → Contact highlighted

Also confirm footer and nav show "Jose C Garcia".

- [ ] **Step 4: Commit**

```bash
git add resources/views/layout.blade.php .gitignore
git commit -m "feat: active nav highlighting, update name to Jose C Garcia"
```

---

## Task 8: Final — Add Real GitHub URLs

**Files:**
- Modify: `database/seeders/ProjectSeeder.php`

- [ ] **Step 1: Add your real GitHub repo URLs**

Open `database/seeders/ProjectSeeder.php`. Fill in the `github_url` fields with your actual repo URLs:

```php
'github_url' => 'https://github.com/YOUR_USERNAME/check-in-app',
// and
'github_url' => 'https://github.com/YOUR_USERNAME/gymnastics-tracker',
// and
'github_url' => 'https://github.com/YOUR_USERNAME/portfolio',
```

- [ ] **Step 2: Re-seed the database**

```bash
php artisan db:seed --class=ProjectSeeder
```

Expected: `Seeding: Database\Seeders\ProjectSeeder` → `Database seeding completed successfully.`

- [ ] **Step 3: Update GitHub link in home.blade.php**

Open `resources/views/home.blade.php`. Replace `https://github.com` in the GitHub button with your actual profile URL:

```blade
<a href="https://github.com/YOUR_USERNAME" target="_blank" ...>
    GitHub ↗
</a>
```

- [ ] **Step 4: Verify GitHub links appear on project cards**

Open `http://localhost:8000/projects`. GitHub ↗ buttons should now appear on each card. Click one — it should open the correct repo.

- [ ] **Step 5: Final commit**

```bash
git add database/seeders/ProjectSeeder.php resources/views/home.blade.php
git commit -m "feat: wire up real GitHub URLs for projects and nav"
```
