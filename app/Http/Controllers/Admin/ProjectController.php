<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {
        $projects = Project::all();
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.projects.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'thumb' => 'required|string',
            'creation_date' => 'required|date',
            'link' => 'required|string',
            'language' => 'required|string'
        ]);

        $data["language"] = explode(', ', $data["language"]);

        $data['slug'] = Str::slug($data['title'], '-');

        // abbreviazione dei metodi: new, fill e save
        $project = Project::create($data);

        return redirect()->route('admin.projects.index', $project->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

        //$project = Project::where("slug", $slug)->first();
        $project = Project::findOrFail($id);
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $project = Project::findOrFail($id);
        return view('admin.projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $project = Project::findOrFail($id);

        $data = $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'thumb' => 'required|string',
            'creation_date' => 'required|date',
            'link' => 'required|string',
            'language' => 'required|string'
        ]);

        $data["language"] = explode(', ', $data["language"]);

        $project->update($data);

        return redirect()->route('admin.projects.show', compact('project'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $project = Project::findOrFail($id);

        $project->delete();

        return redirect()->route('admin.projects.index');
    }
}
