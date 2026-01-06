<?php

namespace App\Service\Admin;

use App\Models\Project;
use Illuminate\Http\UploadedFile;

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
            $data['image'] = $this->convertToBase64($data['image']);
        }

        return Project::create($data);
    }

    public function update(Project $project, array $data): Project
    {
        if (isset($data['image']) && $data['image'] instanceof UploadedFile) {
            $data['image'] = $this->convertToBase64($data['image']);
        }

        $project->update($data);
        return $project;
    }

    public function delete(Project $project): void
    {
        $project->delete();
    }

    private function convertToBase64(UploadedFile $file): string
    {
        $imageData = file_get_contents($file->getRealPath());
        $mimeType = $file->getMimeType();
        $base64 = base64_encode($imageData);
        return 'data:' . $mimeType . ';base64,' . $base64;
    }
}

