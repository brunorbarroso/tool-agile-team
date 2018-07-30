<table class="table">
    <thead>
        <tr>
            <th>Estimativa</th>
            <th>Prioridade</th>
            <th>Conhecimento</th>
        </tr>
    </thead>
    <tbody>
        {!! generateTableClassification($parameters, $selected) !!} 
    </tbody>
</table>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText or 'Create' }}">
    </div>
</div>
