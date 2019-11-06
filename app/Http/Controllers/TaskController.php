<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\TaskRepository;
use Illuminate\Support\Facades\DB;

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

    // Отображение списка всех задач пользователя.
    public function index(Request $request, TaskRepository $tasks)
    {
        $result = $tasks->forUserAllAlive($request->user(), $request);

        return view('tasks.index', ['tasks' => $result, 'user' => $request->user()]);
    }

    // Создание новой задачи.
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

    public function delete(Request $request)
    {
        $task_id = $request->task_id;

        $result = $request->user()->tasks()->find($task_id)->delete();
/*
        $now = date('Y-m-d G:i:s');
        $result = DB::table('tasks')->where('id', $task_id)->update(['deleted_at' => $now]);
*/
        return response()->json(['act' => 'delete', 'success'=> $result, 'error'=>'error', 'task_id' => $task_id]);
    }

    // Выполнить заданную задачу.
    public function complete(Request $request)
    {
        $task_id = $request->task_id;
        $now = date('Y-m-d G:i:s');
        $result = $request->user()->tasks()->where('id', $task_id)->update(['completed_at' => $now]);

        return response()->json(['act' => 'complete', 'success'=> $result, 'error'=>'error', 'task_id' => $task_id]);
    }

    // Выполнить частично заданную задачу.
    public function complete_part(Request $request)
    {
        $task_id = $request->task_id;
        $result = $request->user()->tasks()->where('id', $task_id)->update(['completed_part' => '1']);

        return response()->json(['act' => 'complete_part', 'success'=> $result, 'error'=>'error', 'task_id' => $task_id]);
    }

    // задаче Требуется доп.время.
    public function add_time(Request $request)
    {
        $task_id = $request->task_id;
        $add_time = $request->add_time;
        $result = $request->user()->tasks()->where('id', $task_id)->update(['add_time' => $add_time]);

        return response()->json(['act' => 'add_time', 'success'=> $result, 'error'=>'error', 'task_id' => $task_id]);
    }

    // Выполнить частично заданную задачу.
    public function report(Request $request)
    {
        $task_id = $request->task_id;
        $result = $request->user()->tasks()->where('id', $task_id)->update(['report_id' => '1']);

        return response()->json(['act' => 'report', 'success'=> $result, 'error'=>'error', 'task_id' => $task_id]);
    }
}
