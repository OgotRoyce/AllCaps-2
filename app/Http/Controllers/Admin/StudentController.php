<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Adviser;
use App\Models\Projects;
use App\Http\Requests\StudentRequest;
use Illuminate\Support\Facades\Hash;
use Nette\Utils\Random;
use Illuminate\Support\Str;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::all();
        return view('Admin.Students.index', ['students' => $students]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Admin.Students.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StudentRequest $request)
    {
        // $request->validated($request->all());

        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $filenameWithExt = $photo->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $photo->getClientOriginalExtension();
            $image = $filename . '_' . time() . '.' . $extension;
            $path = $photo->move('pictures', $image);

            $member = Student::create([
                'account_code' => strtoupper(Str::random(10)),
                'first_name' => $request->get('first_name'),
                'last_name' => $request->get('last_name'),
                'email' => $request->get('email'),
                'password' => bcrypt($request->get('password')),
                'photo' => $image,
            ]);
        } else {
            // Set default image filename or return an error message
        }

        return redirect()->route('students_admin')->with('success', 'Student created!');

        // return back()->with('success', 'Course created successfully.');
    }

    /**
     * Display the specified resource.
     */

    // $students = Student::find($id);
    // $projects = Projects::where('user_id', $id)->first();
    // // dd($projects);
    // return view('Admin.Student.view', ['students' => $students, 'projects' => $projects]);

    public function show(string $id)
    {
        $student = Student::with('adviser')->findOrFail($id);
        $project = Projects::where('user_id', $student->id)->first();


        return view('Admin.Students.view', compact('student', 'project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $Student = Student::find($id);
        if (!$Student) {
            return redirect()->route('member')->with('error', 'member not found.');
        }
        return view('Admin.Student.edit', ['Student' => $Student]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $member = Student::find($id);
        $input = $request->all();
        $member->update($input);
        return redirect()->route('member')->with('success', 'Student updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Student::destroy($id);
        return back()->with('success', 'Deleted successfully.');
    }
}
