<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Projects;
use App\Models\Student;
use Illuminate\Http\Request;
use Session;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth('student')->user(); // Get the authenticated user
        // dd($user);
        $projects = Projects::where('user_id', $user->id)
            ->with('user') // Eager load the user details
            ->get(); // Retrieve projects associated with the user

        return view('Student.Project.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Student.Project.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = auth('student')->user();
    
        if ($request->hasFile('logo')) {
            $photo = $request->file('logo');
            $filenameWithExt = $photo->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $photo->getClientOriginalExtension();
            $image = $filename . '_' . time() . '.' . $extension;
            $path = $photo->move('pictures', $image);
    
            $project = Projects::create([
                'title' => $request->get('title'),
                'description' => $request->get('description'),
                'group_name' => $request->get('group_name'),
                'logo' => $image,
                'user_id' => $user->id,
            ]);
    
            $user->update([
                'group_name' => $request->get('group_name'),
            ]);
        } else {
            // Set default image filename or return an error message
        }
    
        Session::flash('success', 'Project created!');
        return redirect()->route('project');
    }
    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
