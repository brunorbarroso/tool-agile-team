@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Edit Classificacao #{{ $task->id }}</div>
                    <div class="card-body">
                        <a href="{{ url('/admin/classificacao') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <br />
                        <br />

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        <form method="POST" action="{{ url('/admin/classificacao/' . $task->id) }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            {{ csrf_field() }}

                            <div class="form-group {{ $errors->has('tarefas_id') ? 'has-error' : ''}}">
                                <label for="tarefas_id" class="col-md-4 control-label">{{ 'Demanda' }}</label>
                                <div class="col-md-8">
                                    {!! Form::select('tarefas_id', $tasks, $task->id, ['class' => 'form-control select2-single' ,'disabled'=>'disabled']) !!}
                                    {!! $errors->first('tarefas_id', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>

                            @include ('admin.classifications.form', ['submitButtonText' => 'Update'])

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
