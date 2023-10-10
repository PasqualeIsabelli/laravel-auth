<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
//use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
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
    public function store(StoreProjectRequest $request)
    {
        $data = $request->validated();

        $data["language"] = explode(', ', $data["language"]);

        $data['slug'] = $this->generateSlug($data['title']);

        $data['thumb'] = Storage::put('projects', $data['thumb']);

        // abbreviazione dei metodi: new, fill e save
        $project = Project::create($data);

        return redirect()->route('admin.projects.index', $project->slug);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {

        $project = Project::where("slug", $slug)->first();
        //$project = Project::findOrFail($id);
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $slug)
    {
        $project = Project::where("slug", $slug)->firstOrFail();
        //$project = Project::findOrFail($id);
        return view('admin.projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, string $slug)
    {
        $data = $request->validated();

        $project = Project::where("slug", $slug)->firstOrFail();
        //$project = Project::findOrFail($id);

        if ($data["title"] !== $project->title) {
            $data["slug"] = $this->generateSlug($data["title"]);
        }

        $data["language"] = explode(', ', $data["language"]);

        //$data['thumb'] = Storage::put('projects', $data['thumb']);

        if(key_exists('thumb', $data)) {
            $data['thumb'] = Storage::put('projects', $data['thumb']);
            Storage::delete($project->thumb);
        }

        $project->update($data);

        return redirect()->route('admin.projects.show', $project->slug);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $slug)
    {
        $project = Project::where("slug", $slug)->firstOrFail();

        if($project->thumb) {
            Storage::delete($project->thumb);
        }

        $project->delete();

        return redirect()->route('admin.projects.index');
    }

    protected function generateSlug($title) {
        $counter = 0;

        do {

            $slug = Str::slug($title) . ($counter > 0 ? '-' . $counter : '');

            $alredyExists = Project::where('slug', $slug)->first();

            $counter++;

        } while ($alredyExists);

        return $slug;
    }
}
