<?php

namespace App\Service\Admin;

use App\Models\User;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Http\UploadedFile;

class ProfileService
{
    public function getProfile(): ?User
    {
        return User::first();
    }

    public function update(User $user, array $data): User
    {
        if (isset($data['image']) && $data['image'] instanceof UploadedFile) {
            // Delete old image from Cloudinary if exists
            if ($user->image && str_contains($user->image, 'cloudinary')) {
                // Extract public_id from URL and delete
                $publicId = $this->extractPublicId($user->image);
                if ($publicId) {
                    Cloudinary::destroy($publicId);
                }
            }

            // Upload new image to Cloudinary
            $uploadedFile = Cloudinary::upload($data['image']->getRealPath(), [
                'folder' => 'portfolio/profile',
            ]);
            $data['image'] = $uploadedFile->getSecurePath();
        }

        $user->update($data);
        return $user;
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

