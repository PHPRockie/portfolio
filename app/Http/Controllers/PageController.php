<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\Message;
use App\Models\Project;

class PageController extends Controller
{
    public function home()
    {
        $featured = Project::where('featured', true)->orderBy('sort_order')->get();
        return view('home', compact('featured'));
    }

    public function about()
    {
        return view('about');
    }

    public function projects()
    {
        $projects = Project::orderBy('sort_order')->get();
        return view('projects.index', compact('projects'));
    }

    public function show(string $slug)
    {
        $project = Project::where('slug', $slug)->firstOrFail();
        return view('projects.show', compact('project'));
    }

    public function contact()
    {
        return view('contact');
    }

    public function send(Request $request)
    {
        $request->validate([
            'name' => 'required|min:2',
            'email' => 'required|email',
            'message' => 'required|min:5',
        ]);

        Message::create($request->only('name', 'email', 'message'));

        Mail::raw(
            "Name: {$request->name}\nEmail: {$request->email}\n\nMessage:\n{$request->message}",
            function ($mail) use ($request) {
                $mail->to(config('mail.from.address'))
                     ->subject("Portfolio contact from {$request->name}");
            }
        );

        return redirect('/contact')->with('success', 'Your message has been sent!');
    }
}
