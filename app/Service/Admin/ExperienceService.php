<?php

namespace App\Service\Admin;

use App\Models\Experience;

class ExperienceService
{
    public function getAll()
    {
        return Experience::latest()->get();
    }

    public function find(int $id): ?Experience
    {
        return Experience::find($id);
    }

    public function store(array $data): Experience
    {
        return Experience::create($data);
    }

    public function update(Experience $experience, array $data): Experience
    {
        $experience->update($data);
        return $experience;
    }

    public function delete(Experience $experience): void
    {
        $experience->delete();
    }
}

