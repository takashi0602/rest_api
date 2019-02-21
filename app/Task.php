<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\ValueObject\TaskObject;

class Task extends Model
{
    protected $table = "tasks";

    public function toValueObject()
    {
        return new TaskObject(
            $this->name,
            $this->created_at
        );
    }
}
