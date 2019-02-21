<?php

use Illuminate\Http\Request;
use App\Task;
use App\User;

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
})->middleware(\Barryvdh\Cors\HandleCors::class);

Route::post("/auth/login", function() {
    $email = request()->get("email");
    $password = request()->get("password");

    $user = User::where("email", $email)->first();
    if ($user && Hash::check($password, $user->password)) {
        $token = str_random();
        $user->token = $token;
        $user->save();
        return [
            "token" => $token,
            "user" => $user
        ];
    } else {
        abort(401);
    }
});

Route::get("/profile", function() {
//    $token = request()->bearerToken();
//    $user = User::where("token", $token)->first();
    $user = Auth::guard("api")->user();
//    if ($token && $user) {
//        return [
//            "user" => $user
//        ];
//    } else {
//        abort(401);
//    }
    return [
        "user" => $user
    ];
})->middleware("auth:api");

Route::post("/auth/logout", function() {
    $token = request()->bearerToken();
    $user = User::where("token", $token)->first();
    if ($user) {
        $user->token = null;
        $user->save();
        return [];
    } else {
        abort(401);
    }
});

Route::get("task/list", \App\Http\Actions\TaskListAction::class."@handle");