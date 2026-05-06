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
            'sort_order' => 1,
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
            'sort_order' => 2,
        ]);

        Project::create([
            'title' => 'Tramp & Mini',
            'slug' => 'tramp-and-mini',
            'summary' => 'Gamified training platform for Trampoline & Double Mini athletes and coaches.',
            'description' => 'A full-stack React application that transforms traditional gymnastics training into an interactive experience. Coaches use mini-games like Connect Four, Tic-Tac-Toe, Hangman, and board challenges to target daily training goals — turning repetitive practice into something athletes actually look forward to. Built with a TypeScript + Supabase stack and designed to run during live training sessions.',
            'tech_stack' => ['React', 'TypeScript', 'Supabase', 'Tailwind CSS', 'Vite'],
            'github_url' => 'https://github.com/PHPRockie/trampandmini',
            'github_private' => true,
            'live_url' => null,
            'featured' => true,
            'problem' => 'Traditional training methods rely on repetition and verbal cues, which can disengage athletes over time. Coaches needed a way to maintain focus and motivation during practice without sacrificing the technical work.',
            'solution' => 'Built a gamified platform where every game mode maps directly to a training goal. Coaches select the game, athletes compete or progress through challenges, and the system tracks results. Supabase powers real-time data so progress is saved instantly.',
            'highlights' => [
                'Mini-games: Connect Four, Tic-Tac-Toe, Hangman, board challenges',
                'Point systems and skill-based rewards to drive engagement',
                'Multiple game modes for coaches to target specific training goals',
                'Supabase backend with real-time data persistence',
            ],
            'sort_order' => 3,
        ]);

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
            'sort_order' => 4,
        ]);

        Project::create([
            'title' => 'Weather App',
            'slug' => 'weather-app',
            'summary' => 'Clean, free weather app focused on simplicity and a better user experience.',
            'description' => 'A React + TypeScript weather application built around a user-first philosophy. Most weather apps overload users with cluttered dashboards and paywalled features. This one strips that away — delivering clean, accurate, and fast weather information in a modern and intuitive interface. Completely free to use.',
            'tech_stack' => ['React', 'TypeScript', 'Vite', 'Tailwind CSS'],
            'github_url' => 'https://github.com/PHPRockie/Weather-App',
            'github_private' => true,
            'live_url' => null,
            'featured' => false,
            'problem' => 'Most weather apps are cluttered, slow, or push users toward paid tiers for basic features. There was no clean, free option that felt modern and actually enjoyable to use.',
            'solution' => 'Built a focused weather experience using React and TypeScript — clean UI, fast data fetching, and only the information that matters. No ads, no paywalls, no noise.',
            'highlights' => [
                'Clean UI focused on useful information only',
                'Real-time weather data via external API',
                'Completely free — no paywalls or ads',
                'Built with React, TypeScript, Vite, and Tailwind CSS',
            ],
            'sort_order' => 5,
        ]);
    }
}
