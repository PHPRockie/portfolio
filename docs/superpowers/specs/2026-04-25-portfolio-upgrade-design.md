# Portfolio Upgrade Design

**Date:** 2026-04-25
**Goal:** Upgrade the Laravel portfolio to make a strong impression on employer/recruiter audiences, positioning Jose as a capable Laravel/PHP backend developer.

---

## Audience & Goal

- **Target:** Employers and recruiters
- **Primary impression:** "This person is a strong Laravel/PHP developer"
- **Secondary:** The portfolio codebase itself should demonstrate Laravel skills (migrations, models, routes, controllers, Blade)

---

## Scope

### In Scope
- Home page hero redesign
- Projects page: data-driven cards from DB
- New project detail page (`/projects/{slug}`)
- About page redesign with experience timeline
- Contact form: inline validation error display
- Global: active nav states, replace placeholder name

### Out of Scope (v2)
- Admin panel for managing projects
- Blog / posts section
- Email notification on contact form submission
- Live URL deployment links (field exists in DB, not linked in UI yet)

---

## Architecture

No new packages required. All changes use existing Laravel stack: Eloquent, Blade, Tailwind CSS, Vite.

### New DB table: `projects`

```
projects
  id
  title          string
  slug           string (unique)
  description    text         — full description for detail page
  summary        string       — one-line for card
  tech_stack     json         — array of tag strings e.g. ["Laravel", "MySQL", "Tailwind"]
  github_url     string nullable
  live_url       string nullable
  featured       boolean default false
  problem        text nullable  — "The Problem" section on detail page
  solution       text nullable  — "The Solution" section on detail page
  highlights     json nullable  — array of bullet strings for sidebar
  sort_order     integer default 0
  timestamps
```

### New files
- `database/migrations/xxxx_create_projects_table.php`
- `database/seeders/ProjectSeeder.php`
- `app/Models/Project.php`
- `resources/views/projects/index.blade.php` (replaces `projects.blade.php`)
- `resources/views/projects/show.blade.php` (new detail page)

### Modified files
- `app/Http/Controllers/PageController.php` — add `show()` method for project detail
- `routes/web.php` — add `/projects/{slug}` route
- `resources/views/home.blade.php` — new hero layout
- `resources/views/about.blade.php` — two-column redesign
- `resources/views/contact.blade.php` — validation error display
- `resources/views/layout.blade.php` — active nav states, real name

---

## Page Designs

### Home Page

Single-column focused hero. No sidebar panel.

- Small tech label: `LARAVEL · PHP · FULL-STACK` (blue, uppercase, letter-spaced)
- Bold h1: "Backend Developer building real tools."
- One-sentence pitch below the headline
- Two CTA buttons: **View Projects** (blue, filled) + **GitHub ↗** (border, links to GitHub profile)
- Fade-in animation (already in app.css)

### Projects Page (`/projects`)

Grid of cards, 2 columns on md+. Data sourced from `projects` table ordered by `sort_order`.

Each card contains:
- Project title (bold)
- Summary (one-line description)
- Tech stack badge pills (colored by category: Laravel=blue, PHP=blue, MySQL=green, Tailwind=purple, SQLite=green, JS=yellow)
- **GitHub ↗** link (shown only if `github_url` is set)
- **Details →** link to `/projects/{slug}`
- Hover: scale-105 transition (already in use)

### Project Detail Page (`/projects/{slug}`)

Two-column layout (stacks on mobile).

**Left column (main):**
- Back link: `← Projects`
- Title + tech stack badge pills
- Full `description` paragraph
- "The Problem" section (from `problem` field)
- "The Solution" section (from `solution` field)
- **View on GitHub ↗** button (shown only if `github_url` set)

**Right column (sidebar):**
- "Stack" card — lists each item in `tech_stack` JSON
- "Highlights" card — lists each item in `highlights` JSON

Returns 404 if slug not found.

### About Page

Two-column layout (stacks on mobile).

**Left column:**
- Short bio paragraph (2–3 sentences, developer story)
- "Experience" section with vertical timeline:
  - Entry: Laravel Developer · 2023–Present · Freelance — built Check-In App, Gymnastics Tracker
  - Entry: Gymnastics Coach · 2018–Present — built tools to solve real coaching problems

**Right column:**
- "Stack" grid: Laravel, PHP 8, MySQL, SQLite, Tailwind CSS, Blade, JavaScript, Vite
- "Resume" section: Download PDF button (links to `/resume.pdf`, can be a placeholder path for now)

### Contact Page

No layout changes. Add:
- `@error` directives below each input/textarea to show validation messages in red
- `old()` helper on input `value` attributes to preserve data on validation failure

### Global / Layout

- **Active nav:** In `layout.blade.php`, compare `request()->is()` to each route and apply `text-blue-400 border-b border-blue-400` to the active link
- **Name:** Replace "PHP Rockie" with "Jose C Garcia" throughout (nav, footer, hero)
- **`.gitignore`:** Add `.superpowers/` entry

---

## Data Seeder

`ProjectSeeder` seeds 3 projects:

1. **Check-In App** — slug: `check-in-app`, tech: [Laravel, MySQL, Tailwind], featured: true
2. **Gymnastics Tracker** — slug: `gymnastics-tracker`, tech: [PHP, SQLite], featured: true
3. **Portfolio** — slug: `portfolio`, tech: [Laravel, Tailwind, Vite], featured: false

GitHub URLs left as empty strings — Jose fills in the real repo URLs after seeding.

---

## Error Handling

- `/projects/{slug}` with unknown slug → `abort(404)`
- Contact form validation failure → redirect back with errors and old input (already uses `redirect()->back()` pattern; add `withErrors` and `withInput`)

---

## Testing

No automated tests in scope. Manual verification:
- Home hero renders correctly
- All 3 project cards appear on `/projects`
- Each card's "Details →" links to correct detail page
- Detail page shows problem/solution/stack/highlights
- About page timeline and stack grid render
- Contact form shows field-level errors on bad input, repopulates fields
- Active nav highlight works on all 4 routes
