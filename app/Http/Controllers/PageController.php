<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\Project;

class PageController extends Controller
{
    public function home()
    {
        return view('home');
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

        return redirect('/contact')->with('success', 'Your message has been saved!');
    }
}
