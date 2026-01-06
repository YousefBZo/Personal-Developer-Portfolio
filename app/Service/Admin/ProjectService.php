<?php

namespace App\Service\Admin;

use App\Models\Project;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
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
            // Upload to Cloudinary
            $uploadedFile = Cloudinary::upload($data['image']->getRealPath(), [
                'folder' => 'portfolio/projects',
            ]);
            $data['image'] = $uploadedFile->getSecurePath();
        }

        return Project::create($data);
    }

    public function update(Project $project, array $data): Project
    {
        if (isset($data['image']) && $data['image'] instanceof UploadedFile) {
            // Delete old image from Cloudinary if exists
            if ($project->image && str_contains($project->image, 'cloudinary')) {
                $publicId = $this->extractPublicId($project->image);
                if ($publicId) {
                    Cloudinary::destroy($publicId);
                }
            }

            // Upload new image to Cloudinary
            $uploadedFile = Cloudinary::upload($data['image']->getRealPath(), [
                'folder' => 'portfolio/projects',
            ]);
            $data['image'] = $uploadedFile->getSecurePath();
        }

        $project->update($data);
        return $project;
    }

    public function delete(Project $project): void
    {
        // Delete image from Cloudinary if exists
        if ($project->image && str_contains($project->image, 'cloudinary')) {
            $publicId = $this->extractPublicId($project->image);
            if ($publicId) {
                Cloudinary::destroy($publicId);
            }
        }

        $project->delete();
    }

    private function extractPublicId(string $url): ?string
    {
        // Extract public_id from Cloudinary URL
        if (preg_match('/\/v\d+\/(.+)\.\w+$/', $url, $matches)) {
            return $matches[1];
        }
        return null;
    }
}

