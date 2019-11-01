<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\TaskRepository;

class TaskController extends Controller
{
    /**
     * Экземпляр TaskRepository.
     *
     * @var TaskRepository
     */
    protected $tasks;

    /**
     * Создание нового экземпляра контроллера.
     *
     * @param  TaskRepository  $tasks
     * @return void
     */
    public function __construct(TaskRepository $tasks)
    {
        $this->middleware('auth');

        $this->tasks = $tasks;
    }

    /**
     * Отображение списка всех задач пользователя.
     *
     * @param  Request  $request
     * @return Response
     */
    public function index(Request $request)
    {
        $result = $this->tasks->forUserAllAlive($request->user(), $request);

        return view('tasks.index', ['tasks' => $result]);
    }

    /**
     * Создание новой задачи.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
        ]);

        $request->user()->tasks()->create([
            'name' => $request->name,
        ]);

        return redirect('/tasks');
    }

    /**
     * Уничтожить заданную задачу.
     *
     * @param  Request  $request
     * @param  Task  $task
     * @return Response
     */
    public function destroy(Request $request, Task $task)
    {
        $this->authorize('is_task_user', $task);

        $task->delete();

        return redirect('/tasks');
    }

    /**
     * Изменить заданную задачу.
     *
     * @param  Request  $request
     * @param  Task  $task
     * @return Response
     */
    public function change(Request $request, Task $task)
    {
        $this->authorize('is_task_user', $task);

        if ($request->complete == 'complete') {

            $task->completed_at = date('Y-m-d G:i:s');

            $task->save();
        }

        return redirect('/tasks');
    }
}
