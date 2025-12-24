<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProfileRequest;
use App\Service\Admin\ProfileService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AdminProfileController extends Controller
{
    public function __construct(
        protected ProfileService $profileService
    ) {}

    public function index(): View
    {
        $profile = Auth::user();
        return view('admin.profile.index', compact('profile'));
    }

    public function update(ProfileRequest $request): RedirectResponse
    {
        $this->profileService->update(Auth::user(), $request->validated());

        return redirect()
            ->route('admin.profile.index')
            ->with('success', 'Profile updated successfully.');
    }
}

