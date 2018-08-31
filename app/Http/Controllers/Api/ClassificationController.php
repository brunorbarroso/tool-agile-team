<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests;
use App\Http\Controllers\ApiController;

use Illuminate\Http\Request;
use App\Contracts\ParameterRepositoryInterface;
use App\Contracts\TaskRepositoryInterface;

class ClassificationController extends Controller
{

    protected $parameter;
    protected $task;

    public function __construct(ParameterRepositoryInterface $parameter, TaskRepositoryInterface $task)
    {
        $this->parameter = $parameter;
        $this->task = $task;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        // Capture all tasks
        $tasks = $this->task->all();

        return view('admin.classifications.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // Capture all parameters and tasks
        $parameters = $this->parameter->all();
        $tasks = $this->task->all()->pluck('title', 'id');
        $selected = false;

        // Convert for format expected on page
        $parameters = prepareParameters($parameters);

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
        // Validate request
        $this->validate($request, [
            'task_id' => 'required',
            'time_id' => 'required',
            'knowledge_id' => 'required',
            'priority_id' => 'required'
        ]);
        
        // Capture task id
        $task_id = $request->input('task_id');

        // Find task by id
        $task = $this->task->find($task_id);
        
        // Prepare array with values and update values in task
        $parameter_id = [
            $request->input('time_id'),
            $request->input('knowledge_id'),
            $request->input('priority_id')
        ];

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
        // Find task by id
        $task = $this->task->find($id);

        // Capture parameters and tasks in data base
        $parameters = $this->parameter->all();
        $parameters = prepareParameters($parameters);
        $tasks = $this->task->all()->pluck('title', 'id');

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
        $task = $this->task->find($id);
        
        // Capture parameters and tasks in data base
        $parameters = $this->parameter->all();
        $parameters = prepareParameters($parameters);
        $tasks = $this->task->all()->pluck('title', 'id');

        // Get parameters selected in task and convert to array
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
        // Validate request
        $this->validate($request, [
            'time_id' => 'required',
            'knowledge_id' => 'required',
            'priority_id' => 'required'
        ]);    
        
        // Find task by id
        $task = $this->task->find($id);
        
        // Prepare array with values and update values in task
        $parameter_id = [
            $request->input('time_id'),
            $request->input('knowledge_id'),
            $request->input('priority_id')
        ];

        $task->parameters()->sync($parameter_id);

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
        // Find task by id and delete
        $task = $this->task->find($id);
        $task->parameters()->sync([]);

        return redirect('admin/classifications')->with('flash_message', "Classificação da tarefa {$id} excluida!");
    }
}
