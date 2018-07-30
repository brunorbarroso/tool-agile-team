<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Contracts\TaskRepositoryInterface;
use App\Task;

class TasksController extends Controller
{

    protected $task;

    public function __construct(TaskRepositoryInterface $task)
    {
        $this->task = $task;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $tasks = Task::where('code', 'LIKE', "%$keyword%")
                ->orWhere('title', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $tasks = Task::latest()->paginate($perPage);
        }

        return view('admin.tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->validate($request, [
			'code' => 'required',
			'title' => 'required'
		]);
        $data = $request->all();
        
        Task::create($data);

        return redirect('admin/tasks')->with('flash_message', 'Tarefa added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $task = Task::findOrFail($id);

        return view('admin.tasks.show', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $task = Task::findOrFail($id);

        return view('admin.tasks.edit', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
			'code' => 'required',
			'title' => 'required'
		]);
        $data = $request->all();
        
        $task = Task::findOrFail($id);
        $task->update($data);

        return redirect('admin/tasks')->with('flash_message', 'Tarefa updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        Task::destroy($id);

        return redirect('admin/tasks')->with('flash_message', 'Tarefa deleted!');
    }
}
