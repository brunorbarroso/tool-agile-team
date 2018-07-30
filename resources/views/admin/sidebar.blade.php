<div class="col-md-3">
    <div class="card">
        <div class="card-header">
            Menu
        </div>

        <div class="card-body">
            <ul class="nav" role="tablist">
                <li role="presentation">
                    <a href="{{ url('/home') }}">
                        Principal
                    </a>
                </li>
                <li role="presentation">
                    <a href="{{ url('/admin/tasks') }}">
                        Tarefas
                    </a>
                </li>
                <li role="presentation">
                    <a href="{{ url('/admin/parameters') }}">
                        Parametros
                    </a>
                </li>
                <li role="presentation">
                    <a href="{{ url('/admin/classifications') }}">
                        Classificações
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
