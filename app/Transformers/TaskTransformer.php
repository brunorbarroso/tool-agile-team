<?php 

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Task;

class TaskTransformer extends TransformerAbstract
{
    public function transform(Task $task)
    {
        return [
            'id'            => (int) $task->id,
            'code'          => (string) $task->code,
            'title'         => (string) $task->title,
        ];
    }
}
