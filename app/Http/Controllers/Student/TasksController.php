<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Activity;
use App\Models\Output;
use App\Models\Projects;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Str;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;

class TasksController extends Controller
{

    // public function index()
    // {
    //     $tasks = Task::all();
    //     $acts = Activity::all();
    //     $outputs = Output::whereIn('activity_code', $acts->pluck('id'))->get();
    //     // dd($outputs);
    //     return view('Student.Task.index', ['tasks' => $tasks, 'acts' => $acts, 'outputs' => $outputs]);
    // }
    public function index()
    {
        $tasks = Task::all();
        $acts = Activity::all();
        $outputs = Output::whereIn('activity_code', $acts->pluck('id'))->get();
        $hasProject = Projects::where('user_id', auth('student')->user()->id)->exists();

        return view('Student.Task.index', ['tasks' => $tasks, 'acts' => $acts, 'outputs' => $outputs, 'hasProject' => $hasProject]);
    }


    // public function index()
    // {
    //     $user = Auth::user();
    //     $student = Student::where('account_code', $user->id)->firstOrFail();
    //     $tasks = Task::all();
    //     $acts = Activity::all();
    //     $outputs = Output::whereIn('activity_code', $acts->pluck('id'))->get();

    //     foreach ($acts as $act) {
    //         $act->submitted = $outputs->where('activity_code', $act->id)
    //             ->where('student_id', $student->id)
    //             ->where('status', 'pending')
    //             ->isNotEmpty();
    //     }

    //     return view('Student.Task.index', ['tasks' => $tasks, 'acts' => $acts, 'outputs' => $outputs]);
    // }



    public function show($taskId)
    {
        $user = auth('student')->user();
        $userAccountCode = $user->account_code;
        // dd($taskId);
        $acts = Activity::findOrFail($taskId);
        // dd($acts);
        $taskCode = $acts->id;
        // dd($taskCode);
        $accout = Output::where([
            ['student_id', $userAccountCode],
            ['activity_code', $taskCode],
        ])->get();
        // dd($accout);
        return view('Student.Task.view', ['acts' => $acts, 'accout' => $accout, 'taskCode' => $taskCode]);
    }


    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'attachments' => 'required|array|min:1',
    //         'attachments.*' => 'required|file|mimes:pdf,doc,docx|max:2048',
    //     ], [
    //         'attachments.required' => 'Please attach your submission file.',
    //     ]);

    //     // file upload
    //     if ($request->hasFile('attachments')) {
    //         $attachmentPaths = [];

    //         foreach ($request->file('attachments') as $attachment) {
    //             if ($attachment->isValid()) {
    //                 $originalFileName = $attachment->getClientOriginalName();
    //                 $fileName = $originalFileName . '_' . uniqid() . '.' . $attachment->extension();
    //                 $attachment->move(public_path('file'), $fileName);
    //                 $attachmentPaths[] = $fileName;
    //             }
    //         }

    //         $attachments = implode(',', $attachmentPaths); // Convert array to comma-separated string
    //     } else {
    //         //   dd('Invalid file');
    //         $request->session()->flash('error', 'Please provide attachment');
    //         // return back()->withInput();
    //     }
    //     // Create a new Task instance
    //     $task = Output::create([
    //         'activity_code' =>  $request->get('activity_code'),
    //         'student_id' =>  $request->get('student_id'),
    //         'first_name' =>  $request->get('first_name'),
    //         'last_name' =>  $request->get('last_name'),
    //         'adviser_id' =>  $request->get('adviser_id'),
    //         'task_code' => $request->get('task_code'),
    //         'title' => $request->get('title'),
    //         'description' => $request->get('description'),
    //         'due_date' => $request->get('due_date'),
    //         'attachments' => $attachments,
    //     ]);

    //     // dd($task);

    //     Session::flash('success', 'Task created!');
    //     return back();
    // }
    public function store(Request $request)
    {
        $request->validate([
            'attachments' => 'required|array|min:1',
            'attachments.*' => 'required|file|mimes:pdf,doc,docx|max:2048',
        ], [
            'attachments.required' => 'Please attach your submission file.',
        ]);

        // Get the output ID
        $outputId = $request->input('output_id');

        // Check if a file is being resubmitted
        if (!empty($outputId) && $request->hasFile('attachments')) {
            // Delete the existing attachments
            $output = Output::findOrFail($outputId);
            $existingAttachments = explode(',', $output->attachments);
            foreach ($existingAttachments as $attachment) {
                $filePath = public_path('file/' . $attachment);
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
            }
        }

        // Process the new file uploads
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

        // Create or update the output
        if (!empty($outputId)) {
            $output = Output::findOrFail($outputId);
            $output->attachments = $attachments;
            $output->save();
        } else {
            // Create a new Output instance
            $output = Output::create([
                'activity_code' => $request->get('activity_code'),
                'student_id' => $request->get('student_id'),
                'first_name' => $request->get('first_name'),
                'last_name' => $request->get('last_name'),
                'adviser_id' => $request->get('adviser_id'),
                'task_code' => $request->get('task_code'),
                'title' => $request->get('title'),
                'description' => $request->get('description'),
                'due_date' => $request->get('due_date'),
                'attachments' => $attachments,
            ]);
        }

        Session::flash('success', 'Task created!');
        return back();
    }
}
