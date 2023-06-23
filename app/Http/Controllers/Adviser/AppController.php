<?php

namespace App\Http\Controllers\Adviser;

use App\Http\Controllers\Controller;
use App\Models\Adviser;
use App\Models\Student;
use Illuminate\Http\Request;

class AppController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $adviser =  auth('adviser')->user();
        $all = Student::where('adviser_id', $adviser->id)->where('status', 'pending')->get();
        return view('Adviser.Application.index', compact('all'));
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
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }


    function acceptPendingRequest(string $id)
    {
        $student = Student::find($id);
        $student->status = 'accepted';

        $adviserId = $student->adviser_id;
        $adviser = Adviser::find($adviserId);
        if ($adviser->counter == 10) {
            return back()->withErrors(['status' => 'Student Not Accepted, You have reached your current limit of 10 students']);
        }

        $adviser->counter = (int)$adviser->counter + 1;
        $adviser->save();
        $student->save();
        return back()->withErrors(['status' => 'Student Accepted']);
    }

    function declinePendingRequest(string $id)
    {
        $student = Student::find($id);
        $student->status = 'declined';
        $student->save();
        return back()->with(['status' => 'Student Declined']);
    }
}
