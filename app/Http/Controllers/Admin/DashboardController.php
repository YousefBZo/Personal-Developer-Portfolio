<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Experience;
use App\Models\Project;
use App\Models\Skill;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $stats = [
            'skills' => Skill::count(),
            'projects' => Project::count(),
            'experiences' => Experience::count(),
            'contacts' => Contact::count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}

