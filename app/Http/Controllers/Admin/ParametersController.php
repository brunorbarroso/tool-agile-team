<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Contracts\ParameterRepositoryInterface;

class ParametersController extends Controller
{

    protected $parameter;
    
    public function __construct(ParameterRepositoryInterface $parameter)
    {
        $this->parameter = $parameter;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $maxPerPage = 25;

        if (!empty($keyword)) {
            $parameters = $this->parameter->search([
                ['name'=>"%$keyword%"],
                ['type'=>"%$keyword%"]
            ], $maxPerPage);
        } else {
            $parameters = $this->parameter->paginate($maxPerPage);
        }

        return view('admin.parameters.index', compact('parameters'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.parameters.create');
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
			'name' => 'required',
			'weight' => 'required',
			'type' => 'required'
		]);
        
        $this->parameter->create($request->all());

        return redirect('admin/parameters')->with('flash_message', 'Parametro added!');
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
        $parameter = $this->parameter->find($id);

        return view('admin.parameters.show', compact('parameter'));
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
        $parameter = $this->parameter->find($id);

        return view('admin.parameters.edit', compact('parameter'));
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
			'name' => 'required',
			'weight' => 'required',
			'type' => 'required'
		]);
        
        $parameter = $this->parameter->find($id);
        $parameter->update($request->all());

        return redirect('admin/parameters')->with('flash_message', 'Parametro updated!');
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
        $this->parameter->delete($id);

        return redirect('admin/parameters')->with('flash_message', 'Parametro deleted!');
    }
}
