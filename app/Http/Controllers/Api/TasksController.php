<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Contracts\TaskRepositoryInterface;
use App\Transformers\TaskTransformer;

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
        $search = getSearchableFields($this->task, $keyword, []);

        if (!empty($keyword)) {
            $tasks = $this->task->search($search, config('app.paginate.maxPerPage'));
        } else {
            $tasks = $this->task->paginate(config('app.paginate.maxPerPage'));
        }

        return $this->response->array($tasks->toArray());
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
        
        $this->task->create( $request->all() );

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
        $task = $this->task->find($id);

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
        $task = $this->task->find($id);

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
        
        $task = $this->task->find($id);
        $task->update($request->all());
        
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
        $this->task->delete($id);

        return redirect('admin/tasks')->with('flash_message', 'Tarefa deleted!');
    }
}
