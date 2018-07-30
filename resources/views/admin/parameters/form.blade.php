<div class="form-group {{ $errors->has('nome') ? 'has-error' : ''}}">
    <label for="nome" class="col-md-4 control-label">{{ 'Nome' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="name" type="text" id="nome" value="{{ $parameter->name or ''}}" required>
        {!! $errors->first('nome', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('peso') ? 'has-error' : ''}}">
    <label for="peso" class="col-md-4 control-label">{{ 'Peso' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="weight" type="text" id="peso" value="{{ $parameter->weight or ''}}" required>
        {!! $errors->first('peso', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('tipo') ? 'has-error' : ''}}">
    <label for="tipo" class="col-md-4 control-label">{{ 'Tipo' }}</label>
    <div class="col-md-6">
        <select name="type" class="form-control" id="tipo" required>
            @foreach (json_decode('{"time":"Tempo","knowledge":"Conhecimento","priority":"Prioridade"}', true) as $optionKey => $optionValue)
                <option value="{{ $optionKey }}" {{ (isset($parameter->type) && $parameter->type == $optionKey) ? 'selected' : ''}}>{{ $optionValue }}</option>
            @endforeach
        </select>
        {!! $errors->first('tipo', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText or 'Create' }}">
    </div>
</div>
