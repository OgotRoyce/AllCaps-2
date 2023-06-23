<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Str;

class TasksController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::all();
        $acts = Activity::all();
        return view('Admin.Tasks.index', ['tasks' => $tasks, 'acts' => $acts]);
    }

    public function AddTask(Request $request){
        
        // Validate the request
        $request->validate([
            'task' => 'required',
        ]);
       
        $user = Task::create([
            'task_code' => strtoupper(Str::random(10)),
            'task' => $request->get('task'),
        ]);
    
        return redirect()->back()->with('success', 'Task created!');
        }

        public function UpdateTask(Request $request, $id){
        
            $tasks = Task::findOrFail($id);

            $tasks->task = $request->input('task');

            $tasks->save();
    
            Session::flash('success', 'Task updated!');
            return redirect()->back()->with('success', 'Task updated!');
            }
        
            public function DeleteTask($code)
            {
                // dd($code);
                $tasks = Task::where('task_code', $code)->get(); 
            
                // Delete activities with the same task code
                Activity::whereIn('task_code', $tasks->pluck('task_code'))->delete();
            
                // Delete tasks with the given task code
                Task::where('task_code', $code)->delete();
            
                return back()->with('success', 'Deleted successfully.');
            }
            

        
    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        // dd($task_code);
        $tasks = Task::find($id);
        // dd($tasks);
        if (!$tasks) {
            return redirect()->route('tasks_admin')->with('error', 'task not found.');
        }
        
        return view('Admin.Tasks.create', ['tasks' => $tasks]);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'due_date' => 'required|date',
            'attachments' => 'nullable|array',
            'attachments.*' => 'nullable|file|mimes:pdf,doc,docx|max:2048', // Define the allowed file types and size
        ]);

       // file upload
       if ($request->hasFile('attachments')) {
        $attachmentPaths = [];
    
        foreach ($request->file('attachments') as $attachment) {
            if ($attachment->isValid()) {
                $originalFileName = $attachment->getClientOriginalName();
                $fileName = $originalFileName . '_' . uniqid() . '.' . $attachment->extension();
                $attachment->move(public_path('file'), $fileName);
                $attachmentPaths[] = $fileName;
            }
        }
    
        $attachments = implode(',', $attachmentPaths); // Convert array to comma-separated string
    } else {
        $attachments = ''; // Assign an empty string if no attachments
    }

        // Create a new Task instance
        $task = Activity::create([
            'task_code' => $request->get('task_code'),
            'title' => $request->get('title'),
            'description' => $request->get('description'),
            'due_date' => $request->get('due_date'),
            'attachments' => $attachments,
        ]);

        // Handle file uploads
        // if ($request->hasFile('attachments')) {
        //     $attachments = $request->file('attachments');
        //     $attachmentPaths = [];

        //     foreach ($attachments as $attachment) {
        //         $path = $attachment->store('attachments'); // Store the file in the "attachments" disk
        //         $attachmentPaths[] = $path;
        //     }

        //     $task->attachments = $attachmentPaths;
        // }
        Session::flash('success', 'Task created!');
        return redirect()->route('tasks_admin');
    }
  
    /**
     * Display the specified resource.
     */
    public function show($taskId)
    {
        $acts = Activity::find($taskId);
        return view('Admin.Tasks.view', compact('acts'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $acts = Activity::findOrFail($id);

        return view('Admin.Tasks.edit', compact('acts'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $acts = Activity::findOrFail($id);
    
        if ($request->hasFile('attachments')) {
            $attachmentPaths = [];
    
            foreach ($request->file('attachments') as $attachment) {
                if ($attachment->isValid()) {
                    $originalFileName = $attachment->getClientOriginalName();
                    $fileName = $originalFileName . '_' . uniqid() . '.' . $attachment->extension();
                    $attachment->move(public_path('file'), $fileName);
                    $attachmentPaths[] = $fileName;
                }
            }
    
            $attachments = implode(',', $attachmentPaths); // Convert array to comma-separated string
            $acts->attachments = $attachments;
        }
    
        $acts->title = $request->input('title');
        $acts->description = $request->input('description');
        $acts->due_date = $request->input('due_date');
    
        $acts->save();
    
        Session::flash('success', 'Task updated!');
    
        return view('Admin.Tasks.view', compact('acts'));
    }
    


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Activity::destroy($id);
        return back()->with('success', 'Deleted successfully.');
    }
}
