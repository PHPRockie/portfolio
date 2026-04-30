<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        Project::query()->delete();

        Project::create([
            'title' => 'Check-In App',
            'slug' => 'check-in-app',
            'summary' => 'Attendance management system for gymnastics classes.',
            'description' => 'A Laravel web application built for a gymnastics gym to replace paper-based attendance tracking. Coaches check athletes in and out of classes, admins view daily reports, and the owner gets monthly summaries.',
            'tech_stack' => ['Laravel', 'MySQL', 'Tailwind CSS'],
            'github_url' => 'https://github.com/PHPRockie/checkin-app',
            'live_url' => null,
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
            'github_url' => 'https://github.com/PHPRockie/gym-turn-tracker',
            'live_url' => null,
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
            'github_url' => 'https://github.com/PHPRockie/portfolio',
            'live_url' => null,
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

        Project::create([
            'title' => 'Tramp & Mini',
            'slug' => 'tramp-and-mini',
            'summary' => 'Visual training games for trampoline and double mini gymnasts.',
            'description' => 'A full-stack React application for gymnastics trampoline and tumbling athletes. It takes a gamified approach to practice — instead of plain checklists, athletes interact with visual games tied to real training goals. Backed by Supabase for real-time data and built with a modern TypeScript stack.',
            'tech_stack' => ['React', 'TypeScript', 'Supabase', 'Tailwind CSS', 'Vite'],
            'github_url' => 'https://github.com/PHPRockie/trampandmini',
            'github_private' => true,
            'live_url' => null,
            'featured' => true,
            'problem' => 'Traditional goal tracking feels disconnected from practice. Athletes needed a more engaging way to work through training objectives on trampoline and double mini without staring at a checklist.',
            'solution' => 'Built interactive visual games that map directly to gymnastics drills and goals. Supabase handles persistence and real-time updates, while shadcn/ui components keep the interface clean and responsive.',
            'highlights' => [
                'Visual game interface tied to real gymnastics training goals',
                'Supabase backend for real-time data persistence',
                'End-to-end tests with Playwright, unit tests with Vitest',
                'Built with React, TypeScript, Tailwind CSS, and shadcn/ui',
            ],
            'sort_order' => 4,
        ]);

        Project::create([
            'title' => 'Weather App',
            'slug' => 'weather-app',
            'summary' => 'React weather app with real-time forecasts and descriptive error handling.',
            'description' => 'A React + TypeScript weather application that fetches real-time weather data from an external API and displays current conditions by location. Built with Vite and Tailwind CSS, with a focus on clean error handling — surfacing meaningful API error messages instead of generic failures.',
            'tech_stack' => ['React', 'TypeScript', 'Vite', 'Tailwind CSS'],
            'github_url' => 'https://github.com/PHPRockie/Weather-App',
            'github_private' => true,
            'live_url' => null,
            'featured' => false,
            'problem' => 'Wanted to practice building a complete React + TypeScript project from scratch: API consumption, async state management, and meaningful error feedback to the user.',
            'solution' => 'Built a focused weather app using React, TypeScript, and Vite. Invested extra care in error handling so users see descriptive messages when an API call fails, not a generic "Search failed" notice.',
            'highlights' => [
                'Real-time weather data via external API',
                'Descriptive API error messages surfaced to the user',
                'Built with React, TypeScript, Vite, and Tailwind CSS',
                'Vitest setup for unit testing',
            ],
            'sort_order' => 5,
        ]);
    }
}
