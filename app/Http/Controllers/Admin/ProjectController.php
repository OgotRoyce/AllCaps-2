<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Projects;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $projects = Projects::with('user')->get();

        return view('Admin.Projects.index', ['projects' => $projects]);
    }
}
