@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">classifications</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-9">
                                <div class="input-group">
                                    <a href="{{ url('/admin/classifications/create') }}" class="btn btn-success btn-sm" title="Add New classifications">
                                        <i class="fa fa-plus" aria-hidden="true"></i> Classificar Tarefa
                                    </a>
                                </div><!-- /input-group -->
                            </div><!-- /.col-lg-6 -->
                            <div class="col-lg-3">
                                <form method="GET" action="{{ url('/admin/classifications') }}" accept-charset="UTF-8" class="form-inline float-right" role="search">
                                    <div class="input-group">
                                        <input type="text" name="search" class="form-control" placeholder="Pesquise por..." value="{{ app('request')->input('search') }}">
                                        <span class="input-group-btn">
                                            <button class="btn btn-secondary" type="submit">
                                                <i class="fa fa-search"></i>
                                            </button>
                                        </span>
                                    </div><!-- /input-group -->
                                </form>
                            </div><!-- /.col-lg-6 -->
                        </div><!-- /.row -->
                        @if (session('flash_message'))
                            <div class="alert alert-success">
                                {{ session('flash_message') }}
                            </div>
                        @endif
                        <br/>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Tarefa</th>
                                        <th>Parametros</th>
                                        <th>Pontos</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($tasks as $item)
                                    <tr>
                                        <td>{{ $loop->iteration or $item->id }}</td>
                                        <td>{{ $item->title }}</td>
                                        <td>
                                            @foreach($item->parameters as $parameter)
                                                {{ $parameter->name }} |
                                            @endforeach
                                        </td>
                                        <td>{{ applyFormula($item->parameters) }}</td>
                                        <td>
                                            <a href="{{ url('/admin/classifications/' . $item->id . '/edit') }}" title="Edit classifications"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</button></a>

                                            <form method="POST" action="{{ url('/admin/classifications' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete classifications" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Excluir</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
