@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">parameters</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-9">
                                <div class="input-group">
                                    <a href="{{ url('/admin/parameters/create') }}" class="btn btn-success btn-sm" title="Add New Parametro">
                                        <i class="fa fa-plus" aria-hidden="true"></i> Add New
                                    </a>
                                </div><!-- /input-group -->
                            </div><!-- /.col-lg-6 -->
                            <div class="col-lg-3">
                                <form method="GET" action="{{ url('/admin/parameters') }}" accept-charset="UTF-8" class="form-inline float-right" role="search">
                                    <div class="input-group">
                                        <input type="text" name="search" class="form-control" placeholder="Pesquise por...">
                                        <span class="input-group-btn">
                                            <button class="btn btn-secondary" type="submit">
                                                <i class="fa fa-search"></i>
                                            </button>
                                        </span>
                                    </div><!-- /input-group -->
                                </form>
                            </div><!-- /.col-lg-6 -->
                        </div><!-- /.row -->
                        <br/>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th><th>Nome</th><th>Peso</th><th>Tipo</th><th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($parameters as $item)
                                    <tr>
                                        <td>{{ $loop->iteration or $item->id }}</td>
                                        <td>{{ $item->name }}</td><td>{{ $item->weight }}</td><td>{{ $item->type }}</td>
                                        <td>
                                            <a href="{{ url('/admin/parameters/' . $item->id) }}" title="View Parametro"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                            <a href="{{ url('/admin/parameters/' . $item->id . '/edit') }}" title="Edit Parametro"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                                            <form method="POST" action="{{ url('/admin/parameters' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete Parametro" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $parameters->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
