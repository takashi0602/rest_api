<?php
namespace App\Http\Responder;

use Illuminate\Support\Collection;

/**
 * タスクの一覧を生成するレスポンス
 * at app/Http/Responder/TaskIndexResponder.php
 */
class TaskIndexResponder
{
    public function emit(Collection $tasks)
    {
        return response($tasks,200);
    }
}