<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    public function index()
    {
        // Only show projects for the current user's clients
        $userClientIds = Client::where('user_id', Auth::id())->pluck('id');
        $projects = Project::with('client')
            ->whereIn('client_id', $userClientIds)
            ->paginate(10);
        return view('projects/index', [
            'projects' => $projects,
        ]);
    }

    public function create()
    {
        return view('projects/create-project', [
            'clients' => Client::all(['id', 'name'])->toArray(),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'rate' => 'nullable|numeric|min:0',
            'total_hours' => 'nullable|numeric|min:0',
        ]);
        Project::create($validated);
        return redirect('/projects')->with('success', 'Project created successfully.');
    }

    public function show(Project $project)
    {
        return view('projects/show', [
            'project' => $project,
        ]);
    }
}
