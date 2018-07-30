<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Parameter;
use App\Task;

class ClassificationController extends Controller
{

    protected $parameters;
    protected $tasks;

    public function getParameters(){
        return $this->parameters;
    }

    public function setParameters(){
        $parameters = Parameter::get();
        $this->parameters = $parameters;
    }

    public function getTasks(){
        return $this->tasks;
    }

    public function setTasks(){
        $tasks = Task::orderBy('title', 'ASC')->pluck('title', 'id');
        $this->tasks = $tasks;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $tasks = Task::get();
        return view('admin.classifications.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $this->setParameters();
        $this->setTasks();

        $parameters = $this->getParameters();
        $parameters = prepareParameters($parameters);
        $tasks = $this->getTasks();
        $selected = false;

        return view('admin.classifications.create', compact('parameters','tasks', 'selected'));
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
            'task_id' => 'required',
            'time_id' => 'required',
            'knowledge_id' => 'required',
            'priority_id' => 'required'
        ]);
        
        $data = $request->all();
        $task_id = $data['task_id'];
        $parameter_id = [$data['time_id'], $data['knowledge_id'], $data['priority_id']];

        $task = Task::find($task_id);

        $task->parameters()->attach($parameter_id);

        return redirect('admin/classifications')->with('flash_message', "Classificação da tarefa {$task_id} criada!");
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
        $this->setParameters();
        $this->setTasks();

        $parameters = $this->getParameters();
        $parameters = prepareParameters($parameters);
        $tasks = $this->getTasks();

        //return $task->parametros();

        return view('admin.classifications.show', compact('task', 'tasks', 'parameters'));
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
        // Find task by id
        $task = Task::findOrFail($id);
        $this->setParameters();
        $this->setTasks();
        
        // Capture parameters and tasks in data base
        $parameters = $this->getParameters();
        $parameters = prepareParameters($parameters);
        $tasks = $this->getTasks();

        // Get parameters selected in task
        $selected = $task->parameters()->get()->toArray();
        $selected = array_column($selected, 'id');

        return view('admin.classifications.edit', compact('task', 'tasks', 'parameters', 'selected'));
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
            'time_id' => 'required',
            'knowledge_id' => 'required',
            'priority_id' => 'required'
		]);
        $data = $request->all();
        $parameters_id = [$data['time_id'], $data['knowledge_id'], $data['priority_id']];

        $task = Task::find($id);

        $task->parameters()->sync($parameters_id);

        return redirect('admin/classifications')->with('flash_message', "Classificação da tarefa {$id} atualizada!");
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
        $task = Task::find($id);
        $task->parameters()->sync([]);

        return redirect('admin/classifications')->with('flash_message', "Classificação da tarefa {$id} excluida!");
    }
}
