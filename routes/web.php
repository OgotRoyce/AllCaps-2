<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::redirect('/', '/admin');
Route::get('/admin', function () {
    return view('Admin/Auth/login');
});


Route::get('/adviser', function () {
    return view('Adviser/Auth/login');
});


Route::get('/student', function () {
    return view('Student/Auth/login');
});

// Route::redirect('/', '/admin/login');

//Admin routes
Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {

    Route::group(['prefix' => 'login',], function () {
        Route::get('/', ['as' => 'login_admin', 'uses' => 'AuthController@login']);
        Route::post('/authenticated', ['as' => 'authenticated', 'uses' => 'AuthController@authenticated']);
        Route::post('/logout', ['as' => 'logout_admin', 'uses' => 'AuthController@logout']);
    });

    Route::group(['prefix' => 'tasks_admin'], function () {
        Route::get('/', ['as' => 'tasks_admin', 'uses' => "TasksController@index"]);
        Route::get('/create/{id}', ['as' => 'create_tasks', 'uses' => "TasksController@create"]);
        Route::post('/AddTask', ['as' => 'add_new_task', 'uses' => "TasksController@AddTask"]);
        Route::post('/store', ['as' => 'store_tasks', 'uses' => "TasksController@store"]);
        Route::get('/show/{id}', ['as' => 'view_tasks', 'uses' => "TasksController@show"]);
        Route::get('/edit/{id}', ['as' => 'edit_tasks', 'uses' => "TasksController@edit"]);
        Route::put('/update/{id}', ['as' => 'update_acts', 'uses' => "TasksController@update"]);
        Route::put('/UpdateTask/{id}', ['as' => 'update_tasks', 'uses' => "TasksController@UpdateTask"]);
        Route::delete('/destroy/{id}', ['as' => 'delete_acts', 'uses' => "TasksController@destroy"]);
        Route::delete('/DeleteTask/{code}', ['as' => 'delete_tasks', 'uses' => "TasksController@DeleteTask"]); //Task with s for admin
    });

    Route::group(['prefix' => 'projects_admin'], function () {
        Route::get('/', ['as' => 'projects_admin', 'uses' => "ProjectController@index"]);
    });

    Route::group(['prefix' => 'submissions_admin'], function () {
        Route::get('/{id}', ['as' => 'submissions_admin', 'uses' => "SubmissionController@index"]);
    });

    Route::group(['prefix' => 'students_admin'], function () {
        Route::get('/', ['as' => 'students_admin', 'uses' => "StudentController@index"]);
        Route::get('/create', ['as' => 'create_student', 'uses' => "StudentController@create"]);
        Route::post('/create', ['as' => 'store_student', 'uses' => "StudentController@store"]);
        Route::get('/show/{id}', ['as' => 'view_student', 'uses' => "StudentController@show"]);
    });

    Route::group(['prefix' => 'adviser_admin'], function () {
        Route::get('/', ['as' => 'adviser', 'uses' => "AdviserController@index"]);
        Route::get('/create', ['as' => 'create_adviser', 'uses' => "AdviserController@create"]);
        Route::post('/create', ['as' => 'store_adviser', 'uses' => "AdviserController@store"]);
        Route::get('/edit/{id}', ['as' => 'edit_adviser', 'uses' => "AdviserController@edit"]);
        Route::put('/update/{id}', ['as' => 'update_adviser', 'uses' => "AdviserController@update"]);
        Route::delete('/delete/{id}', ['as' => 'delete_adviser', 'uses' => "AdviserController@destroy"]);
        Route::get('/show/{id}', ['as' => 'view_adviser', 'uses' => "AdviserController@show"]);
        Route::get('/adviser/{id}/students/count', 'AdviserController@studentsCount')->name('adviser.students.count');
        // Route::get('/show/{id}', ['as' => 'view_advisee', 'uses' => "AdviserController@show"]);
    });
});

//Adviser routes
Route::group(['prefix' => 'adviser', 'namespace' => 'Adviser'], function () {

    Route::group(['prefix' => 'login',], function () {
        Route::get('/', ['as' => 'login_adviser', 'uses' => 'AuthController@login']);
        Route::post('/authenticate', ['as' => 'authenticate', 'uses' => 'AuthController@authenticate']);
        Route::post('/logout', ['as' => 'logout_adviser', 'uses' => 'AuthController@logout']);
    });

    Route::group(['prefix' => 'application',], function () {
        Route::get('/', ['as' => 'application', 'uses' => 'AppController@index']);
        Route::post('/acceptPendingRequest/{id}', ['as' => 'acceptPendingRequest', 'uses' => 'AppController@acceptPendingRequest']);
        Route::post('/declinePendingRequest/{id}', ['as' => 'declinePendingRequest', 'uses' => 'AppController@declinePendingRequest']);
    });

    Route::group(['prefix' => 'advisoree',], function () {
        Route::get('/', ['as' => 'advisoree', 'uses' => 'AdvisoreeController@index']);
        Route::delete('/delete/{id}', ['as' => 'delete_advisoree', 'uses' => "AdvisoreeController@destroy"]);
        Route::get('/show/{id}', ['as' => 'view_advisoree', 'uses' => "AdvisoreeController@show"]);
    });
    Route::group(['prefix' => 'adviser_task',], function () {
        Route::get('/', ['as' => 'adviser_task', 'uses' => 'TasksController@index']);
        Route::get('/create/{id}', ['as' => 'create_adviser_tasks', 'uses' => "TasksController@create"]);
        Route::post('/AddTask', ['as' => 'add_adviser_task', 'uses' => "TasksController@AddTask"]);
        Route::post('/store', ['as' => 'store_adviser_tasks', 'uses' => "TasksController@store"]);
        Route::get('/show/{id}', ['as' => 'view_adviser_tasks', 'uses' => "TasksController@show"]);
        Route::get('/edit/{id}', ['as' => 'edit_adviser_tasks', 'uses' => "TasksController@edit"]);
        Route::put('/update/{id}', ['as' => 'update_adviser_acts', 'uses' => "TasksController@update"]);
        Route::put('/UpdateTask/{id}', ['as' => 'update_adviser_tasks', 'uses' => "TasksController@UpdateTask"]);
        Route::delete('/destroy/{id}', ['as' => 'delete_adviser_acts', 'uses' => "TasksController@destroy"]);
        Route::delete('/DeleteTask/{code}', ['as' => 'delete_adviser_tasks', 'uses' => "TasksController@DeleteTask"]);
    });

    Route::group(['prefix' => 'submissions_adviser'], function () {
        Route::get('/{id}', ['as' => 'submissions_adviser', 'uses' => "SubmissionController@index"]);
        Route::put('/accept/{task_code}', ['as' => 'accept_tasks', 'uses' => "SubmissionController@accept"]);
        Route::put('/reject/{task_code}', ['as' => 'reject_tasks', 'uses' => "SubmissionController@reject"]);

        Route::put('/update/{task_code}', ['as' => 'review_tasks', 'uses' => "SubmissionController@update"]);
    });
});


//Student routes
Route::group(['prefix' => 'student', 'namespace' => 'Student'], function () {

    Route::group(['prefix' => 'login',], function () {
        Route::get('/', ['as' => 'login_student', 'uses' => 'AuthController@login']);
        Route::post('/auth', ['as' => 'auth', 'uses' => 'AuthController@auth']);
        Route::post('/logout', ['as' => 'logout_student', 'uses' => 'AuthController@logout']);
    });

    Route::group(['prefix' => 'task_student'], function () {
        Route::get('/', ['as' => 'task_student', 'uses' => "TasksController@index"]);
        Route::get('/show/{id}', ['as' => 'view_student_tasks', 'uses' => "TasksController@show"]);
        Route::post('/store', ['as' => 'submit_task', 'uses' => "TasksController@store"]);
    });

    Route::group(['prefix' => 'student_adviser',], function () {
        Route::get('/', ['as' => 'student_adviser', 'uses' => 'AdviserController@index']);
        Route::post('/update/{id}', ['as' => 'choose_adviser', 'uses' => 'AdviserController@update']);
    });

    Route::group(['prefix' => 'project',], function () {
        Route::get('/', ['as' => 'project', 'uses' => 'ProjectController@index']);
        Route::get('/create', ['as' => 'create_project', 'uses' => 'ProjectController@create']);
        Route::post('/create', ['as' => 'store_project', 'uses' => 'ProjectController@store']);
    });

    Route::group(['prefix' => 'student_profile',], function () {
        Route::get('/', ['as' => 'student_profile', 'uses' => 'ProfileController@index']);
    });
});
