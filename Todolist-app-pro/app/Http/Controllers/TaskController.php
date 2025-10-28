<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Models\Task;
use App\Services\Tasks\TaskService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }
    public function index()
    {
        //
        $tasks = $this->taskService->getAllTask();
        return view('tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TaskRequest $request)
    {
        //
        $data = array_merge($request->all(),
        ['user_id' => Auth::id()]);
        $this->taskService->createTask($data);
        return redirect()->route('tasks.index')->with('message', 'Create task successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        //
        $task = $this->taskService->getTaskById($id);
        return view('tasks.show', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $task = $this->taskService->getTaskById($id);
        return view('tasks.edit', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TaskRequest $request, int $id)
    {
        //
        $this->taskService->updateTaskById($request->all(), $id);
        return redirect()->route('tasks.index')->with('message', 'Update task successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        //
        $this->taskService->deleteTask($id);
        return redirect()->route('tasks.index')->with('message', 'Delete task successfully');
    }
}
