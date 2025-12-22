<?php

namespace App\Service\Admin;

use App\Models\Skill;

class SkillService
{
    public function getAll()
    {
        return Skill::latest()->get();
    }

    public function find(int $id): ?Skill
    {
        return Skill::find($id);
    }

    public function store(array $data): Skill
    {
        return Skill::create($data);
    }

    public function update(Skill $skill, array $data): Skill
    {
        $skill->update($data);
        return $skill;
    }

    public function delete(Skill $skill): void
    {
        $skill->delete();
    }
}
