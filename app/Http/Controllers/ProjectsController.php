<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Project;

class ProjectsController extends Controller
{
    public function index()
    {
        // $projects = Project::all();
        $projects = auth()->user()->projects;

        return view('projects.index', compact('projects'));
    }

    public function show(Project $project)
    {
        if (auth()->id() !== (int) $project->user_id) {
            abort(403);
        }

        return view('projects.show', compact('project'));
    }

    public function store()
    {
        // validate
        $attributes = request()->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        // persist
        auth()->user()->projects()->create($attributes);

        // redirect
        return redirect('/projects');
    }
}
