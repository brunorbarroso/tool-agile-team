<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Parameter;

class ParametersController extends Controller
{
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
            $parameters = Parameter::where('name', 'LIKE', "%$keyword%")
                ->orWhere('type', 'LIKE', "%$keyword%")
                ->orderBy('weight', 'asc')->paginate($perPage);
        } else {
            $parameters = Parameter::orderBy('type', 'asc')->orderBy('weight', 'asc')->paginate($perPage);
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
        $data = $request->all();
        
        Parameter::create($data);

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
        $parameter = Parameter::findOrFail($id);

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
        $parameter = Parameter::findOrFail($id);

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
        $data = $request->all();
        
        $parameter = Parameter::findOrFail($id);
        $parameter->update($data);

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
        Parameter::destroy($id);

        return redirect('admin/parameters')->with('flash_message', 'Parametro deleted!');
    }
}
