<?php

namespace App\Service\Admin;

use App\Models\Project;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;
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
            try {
                if ($this->isCloudinaryConfigured()) {
                    $data['image'] = $this->uploadToCloudinary($data['image']);
                } else {
                    $data['image'] = $data['image']->store('projects', 'public');
                }
            } catch (\Exception $e) {
                Log::error('Project image upload failed: ' . $e->getMessage());
                unset($data['image']);
            }
        }

        return Project::create($data);
    }

    public function update(Project $project, array $data): Project
    {
        if (isset($data['image']) && $data['image'] instanceof UploadedFile) {
            try {
                if ($this->isCloudinaryConfigured()) {
                    $data['image'] = $this->uploadToCloudinary($data['image'], $project->image);
                } else {
                    if ($project->image && !str_starts_with($project->image, 'http')) {
                        Storage::disk('public')->delete($project->image);
                    }
                    $data['image'] = $data['image']->store('projects', 'public');
                }
            } catch (\Exception $e) {
                Log::error('Project image upload failed: ' . $e->getMessage());
                unset($data['image']);
            }
        }

        $project->update($data);
        return $project;
    }

    public function delete(Project $project): void
    {
        // Delete image if exists
        if ($project->image) {
            try {
                if (str_contains($project->image, 'cloudinary') && $this->isCloudinaryConfigured()) {
                    $publicId = $this->extractPublicId($project->image);
                    if ($publicId) {
                        \CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary::destroy($publicId);
                    }
                } elseif (!str_starts_with($project->image, 'http')) {
                    Storage::disk('public')->delete($project->image);
                }
            } catch (\Exception $e) {
                Log::error('Failed to delete project image: ' . $e->getMessage());
            }
        }

        $project->delete();
    }

    private function isCloudinaryConfigured(): bool
    {
        $cloudUrl = config('cloudinary.cloud_url');
        return !empty($cloudUrl) && !str_contains($cloudUrl, ':@');
    }

    private function uploadToCloudinary(UploadedFile $file, ?string $oldImage = null): string
    {
        // Delete old image from Cloudinary if exists
        if ($oldImage && str_contains($oldImage, 'cloudinary')) {
            $publicId = $this->extractPublicId($oldImage);
            if ($publicId) {
                \CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary::destroy($publicId);
            }
        }

        // Upload new image to Cloudinary
        $uploadedFile = \CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary::upload($file->getRealPath(), [
            'folder' => 'portfolio/projects',
        ]);

        return $uploadedFile->getSecurePath();
    }

    private function extractPublicId(string $url): ?string
    {
        if (preg_match('/\/v\d+\/(.+)\.\w+$/', $url, $matches)) {
            return $matches[1];
        }
        return null;
    }
}

