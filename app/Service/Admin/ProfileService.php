<?php

namespace App\Service\Admin;

use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ProfileService
{
    public function getProfile(): ?User
    {
        return User::first();
    }

    public function update(User $user, array $data): User
    {
        if (isset($data['image']) && $data['image'] instanceof UploadedFile) {
            try {
                // Check if Cloudinary is configured
                if ($this->isCloudinaryConfigured()) {
                    $data['image'] = $this->uploadToCloudinary($data['image'], $user->image);
                } else {
                    // Fallback to local storage
                    if ($user->image && !str_starts_with($user->image, 'http')) {
                        Storage::disk('public')->delete($user->image);
                    }
                    $data['image'] = $data['image']->store('profile', 'public');
                }
            } catch (\Exception $e) {
                Log::error('Image upload failed: ' . $e->getMessage());
                unset($data['image']); // Don't update image if upload fails
            }
        }

        $user->update($data);
        return $user;
    }

    private function isCloudinaryConfigured(): bool
    {
        $cloudUrl = config('cloudinary.cloud_url');
        Log::info('Cloudinary URL check: ' . ($cloudUrl ? 'configured' : 'not configured'));
        return !empty($cloudUrl) && !str_contains($cloudUrl, ':@');
    }

    private function uploadToCloudinary(UploadedFile $file, ?string $oldImage): string
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
            'folder' => 'portfolio/profile',
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

