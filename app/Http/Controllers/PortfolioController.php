<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Experience;
use App\Models\Project;
use App\Models\Skill;
use App\Models\User;
use Illuminate\View\View;

class PortfolioController extends Controller
{
    public function index(): View
    {
        $profile = User::first();
        $skills = Skill::all();
        $projects = Project::latest()->get();
        $experiences = Experience::orderBy('start_date', 'desc')->get();
        $contacts = Contact::all();

        return view('portfolio', compact('profile', 'skills', 'projects', 'experiences', 'contacts'));
    }
}


