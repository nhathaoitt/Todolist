<?php

namespace App\Services\Tasks;

use App\Models\Task;
use App\Services\BaseService;
use Illuminate\Support\Facades\DB;

class TaskService extends BaseService {
    
    public function getAllTask()
    {
        $tasks = Task::with('user')->orderBy('due_date')->paginate(10);
        return $tasks;
    }
    public function createTask($data)
    {
        $task = Task::create($data);
        return $task;
    } 
    public function getTaskById(int $id)
    {
        try{
            $task = Task::findOrFail($id);
        }catch(\Exception $e){
            abort(404, 'Task không tồn tại')
;       }
        return $task;
    }
    public function updateTaskById($data,int $id)
    {
        try{
            /** @var \App\Models\Task $task */
            $task = $this->getTaskById($id);
            $task->update($data);
        }catch(\Exception $e){
            abort(404, 'Task không tồn tại')
;       }
        return $task;
    }
    public function deleteTask(int $id)
    {
        $task = Task::findOrFail($id);
        Task::delete($task);
        return true;
    }
}