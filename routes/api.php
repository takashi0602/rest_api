<?php

use Illuminate\Http\Request;
use App\Task;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//Route::get("/tasks",function(){
//    return Task::all();
//});

//Route::get("/tasks",function(){
//    return [
//        "status" => "OK",
//        "tasks" => Task::all(),
//    ];
//});

Route::get("tasks", \App\Http\Actions\TaskIndexAction::class."@handle");

Route::post("/task",function(){
    $payload = request()->all();
    $task = new Task();
//    $task->name = request()->get("name");
    $task->name = $payload["name"];
    $task->save();
    return [];
});

Route::delete("/task/{id}",function($id){
    $task = Task::find($id);
    if($task){
        $task->delete();
    }
    return [];
});

//Route::get("status", function(){
//    return [
//        "status" => "OK",
//        "message" => "no issues with systemn"
//    ];
//});

Route::get("status", function(){
    $headers = [
        "X-PAGE" => 1
    ];
    return response([
        "status" => "OK",
        "message" => "no issues with systemn"
    ], 200, $headers);
});