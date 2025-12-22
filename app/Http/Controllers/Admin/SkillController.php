<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SkillRequest;
use App\Models\Skill;
use App\Service\Admin\SkillService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class SkillController extends Controller
{
    public function __construct(
        protected SkillService $skillService
    ) {}

    public function index(): View
    {
        $skills = $this->skillService->getAll();
        return view('admin.skills.index', compact('skills'));
    }

    public function store(SkillRequest $request): RedirectResponse
    {
        $this->skillService->store($request->validated());

        return redirect()
            ->route('admin.skills.index')
            ->with('success', 'Skill created successfully.');
    }

    public function update(SkillRequest $request, Skill $skill): RedirectResponse
    {
        $this->skillService->update($skill, $request->validated());

        return redirect()
            ->route('admin.skills.index')
            ->with('success', 'Skill updated successfully.');
    }

    public function destroy(Skill $skill): RedirectResponse
    {
        $this->skillService->delete($skill);

        return redirect()
            ->route('admin.skills.index')
            ->with('success', 'Skill deleted successfully.');
    }
}

