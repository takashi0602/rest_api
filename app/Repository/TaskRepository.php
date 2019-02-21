<?php
namespace App\Repository;

use App\Task;

class TaskRepository implements TaskRepositoryInterface
{
    public function getList($sort, $limit)
    {
        $query = new Task();
        $query = $query->orderBy("created_at", $sort);
        $query = $query->limit($limit);

        $result = $query->get();

        $rtn = [];
        foreach ($result as $row) {
            $rtn[] = $row->toValueObject();
        }
        return $rtn;
    }

}