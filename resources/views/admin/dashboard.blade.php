@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Principal</div>

                    <div class="card-body">
                        Seja bem-vindo ao sistema de pontuação.
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
