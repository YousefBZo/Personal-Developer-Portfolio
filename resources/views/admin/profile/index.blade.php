@extends('layouts.admin')

@section('title', 'Edit Profile')

@section('content')
<div class="max-w-3xl">
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="p-6 space-y-6">
                <!-- Profile Image -->
                <div class="flex items-center space-x-6">
                    <div class="shrink-0">
                        @if($profile->image)
                            <img class="h-24 w-24 object-cover rounded-full"
                                 src="{{ Storage::url($profile->image) }}"
                                 alt="{{ $profile->name }}">
                        @else
                            <div class="h-24 w-24 rounded-full bg-gray-200 flex items-center justify-center">
                                <svg class="h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                            </div>
                        @endif
                    </div>
                    <div class="flex-1">
                        <label class="block text-sm font-medium text-gray-700">Profile Photo</label>
                        <input type="file" name="image" accept="image/*"
                               class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                        <p class="mt-1 text-xs text-gray-500">JPG, PNG, GIF up to 2MB</p>
                    </div>
                </div>

                <!-- Name -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Full Name</label>
                    <input type="text" name="name" id="name" required
                           value="{{ old('name', $profile->name) }}"
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                </div>

                <!-- Major/Title -->
                <div>
                    <label for="major" class="block text-sm font-medium text-gray-700">Major / Job Title</label>
                    <input type="text" name="major" id="major"
                           value="{{ old('major', $profile->major) }}"
                           placeholder="e.g., Full Stack Developer, Computer Science Student"
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                </div>

                <!-- Bio -->
                <div>
                    <label for="bio" class="block text-sm font-medium text-gray-700">Bio / About Me</label>
                    <textarea name="bio" id="bio" rows="5"
                              placeholder="Write a brief description about yourself..."
                              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('bio', $profile->bio) }}</textarea>
                    <p class="mt-1 text-xs text-gray-500">This will be displayed on your portfolio homepage.</p>
                </div>
            </div>

            <div class="bg-gray-50 px-6 py-3 flex justify-end">
                <button type="submit"
                        class="inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:text-sm">
                    Save Changes
                </button>
            </div>
        </form>
    </div>

    <!-- Account Info (Read-only) -->
    <div class="mt-6 bg-white rounded-lg shadow overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-medium text-gray-900">Account Information</h3>
        </div>
        <div class="p-6 space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-500">Email Address</label>
                <p class="mt-1 text-sm text-gray-900">{{ $profile->email }}</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-500">Member Since</label>
                <p class="mt-1 text-sm text-gray-900">{{ $profile->created_at->format('F d, Y') }}</p>
            </div>
        </div>
    </div>
</div>
@endsection

