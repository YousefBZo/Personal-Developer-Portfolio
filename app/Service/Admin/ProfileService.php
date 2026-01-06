<?php

namespace App\Service\Admin;

use App\Models\User;
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
            // Convert image to Base64 and store in database
            $imageData = file_get_contents($data['image']->getRealPath());
            $mimeType = $data['image']->getMimeType();
            $base64 = base64_encode($imageData);
            $data['image'] = 'data:' . $mimeType . ';base64,' . $base64;
        }

        $user->update($data);
        return $user;
    }
}

