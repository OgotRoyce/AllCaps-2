<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Adviser;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;

class AdviserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth('student')->user();
        $userID = $user->adviser_id;
 
        // dd($userID);

        $myadviser = Adviser::where('id', $userID)->first();

        // dd($myadviser);
        $advisers = Adviser::all();
        return view('Student.Adviser.index', ['advisers' => $advisers, 'myadviser'=>$myadviser]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user =  auth('student')->user();
        // $project = Projects::where('user_id', $user->id)->first();
        $student = Student::where('id', $user->id)->first();
        // dd($student);
        $student->adviser_id = $id;
        $student->status = 'pending';
        $student->save();
        return back();
        // Projects::update()
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
