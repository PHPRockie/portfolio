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
            'github_url' => null,
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
            'github_url' => null,
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
            'github_url' => null,
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
    }
}
