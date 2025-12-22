<?php

namespace App\Service\Admin;

use App\Models\Project;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ProjectService
{
    public function getAll()
    {
        return Project::latest()->get();
    }

    public function find(int $id): ?Project
    {
        return Project::find($id);
    }

    public function store(array $data): Project
    {
        if (isset($data['image']) && $data['image'] instanceof UploadedFile) {
            $data['image'] = $data['image']->store('projects', 'public');
        }

        return Project::create($data);
    }

    public function update(Project $project, array $data): Project
    {
        if (isset($data['image']) && $data['image'] instanceof UploadedFile) {
            // Delete old image if exists
            if ($project->image) {
                Storage::disk('public')->delete($project->image);
            }
            $data['image'] = $data['image']->store('projects', 'public');
        }

        $project->update($data);
        return $project;
    }

    public function delete(Project $project): void
    {
        // Delete image if exists
        if ($project->image) {
            Storage::disk('public')->delete($project->image);
        }

        $project->delete();
    }
}

