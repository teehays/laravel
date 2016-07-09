<?php

use App\Task;
use Illuminate\Http\Request;
use MySQLHandler\MySQLHandler;
use DB;

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


//Route::get('/', function () {
//
//    $tasks = Task::orderBy('created_at', 'asc')->get();
//    return view('tasks',['tasks' => $tasks]);
//});

Route::get('/', function () {
    return view('welcome');
});

// Authentication Routes.

Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration Routes.
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');


/**
 *Add a new task
 */
Route::post('/task', function(Request $request ) {
    $validator = Validator::make($request->all(),
                                 ['name'    => 'required|max:255',]);
    if($validator->fails()) {
        return redirect('/')
                ->withInput()
                ->withErrors($validator);
    }
    
    $task = new Task;
    $task->name = $request->name;
    $task->save();

    return redirect('/');
   
});

Route::get('/log', function(Request $request ) {

    $pdo = DB::connection()->getPdo();
    dump($pdo);

    $mySQLHandler = new MySQLHandler($pdo, 'tee_log', array('username', 'userid'), \Monolog\Logger::DEBUG);

    $logger = new \Monolog\Logger('Test');
    $logger->pushHandler($mySQLHandler);

    //Now you can use the logger, and further attach additional information
    $logger->addWarning("This is a great message, woohoo!", array('username'  => 'John Doe', 'userid'  => 245));


    dump('Hello');



});


/**
 * Delete an existing task
 */

 Route::delete('/task/{id}', function ($id) {
    Task::findOrFail($id)->delete();

    return redirect('/');
});
