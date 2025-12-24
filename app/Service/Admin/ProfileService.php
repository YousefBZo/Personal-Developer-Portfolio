<?php

namespace App\Service\Admin;

use App\Models\User;
use Illuminate\Http\UploadedFile;
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
            // Delete old image if exists
            if ($user->image) {
                Storage::disk('public')->delete($user->image);
            }
            $data['image'] = $data['image']->store('profile', 'public');
        }

        $user->update($data);
        return $user;
    }
}

