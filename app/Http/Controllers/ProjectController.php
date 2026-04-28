<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Workspace;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = auth()->user()->projects()->with('workspace')->latest()->get();
        return view('projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = auth()->user();

        if ($user->workspaces()->count() === 0) {
            $user->workspaces()->create([
                'name' => 'Personal Workspace',
                'slug' => \Illuminate\Support\Str::slug($user->name . '-workspace-' . rand(1000, 9999)),
                'description' => 'Your default personal workspace.'
            ]);
        }

        $workspaces = $user->workspaces;
        return view('projects.create', compact('workspaces'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'required|date',
            'workspace_id' => 'required|exists:workspaces,id',
        ]);

        $request->user()->projects()->create($validated);

        return redirect()->route('projects.index')->with('success', 'Project created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        // $this->authorize('view', $project); // Commented out until Policy is created/registered
        $project->load([
            'tasks.assignee',
            'tasks' => function ($query) {
                $query->latest();
            }
        ]);

        return view('projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
