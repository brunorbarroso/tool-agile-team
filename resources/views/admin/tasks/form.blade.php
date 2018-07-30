<div class="form-group {{ $errors->has('codigo') ? 'has-error' : ''}}">
    <label for="codigo" class="col-md-4 control-label">{{ 'Codigo' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="code" type="text" id="codigo" value="{{ $task->code or ''}}" required>
        {!! $errors->first('codigo', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('titulo') ? 'has-error' : ''}}">
    <label for="titulo" class="col-md-4 control-label">{{ 'Titulo' }}</label>
    <div class="col-md-6">
        <textarea class="form-control" rows="5" name="title" type="textarea" id="titulo" required>{{ $task->title or ''}}</textarea>
        {!! $errors->first('titulo', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText or 'Create' }}">
    </div>
</div>
