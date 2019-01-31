<?php
namespace App\Http\Actions;

use App\Http\Responder\TaskIndexResponder;
use App\Task;

/**
 * タスクの一覧を生成するレスポンス
 * at app/Http/Actions/TaskIndexAction.php
 */
class TaskIndexAction
{
    public function handle(TaskIndexResponder $responder)
    {
        $tasks = Task::all();
        return $responder->emit($tasks);
    }
}