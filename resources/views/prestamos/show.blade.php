@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <ul class="nav nav-pills nav-stacked">
                    <li @if(Route::is('prestamos.show')) class="active" @endif>
                        <a href="{{ route('prestamos.show',$prestamo) }}">Datos del Prestamo</a>
                    </li>
                    @if(Auth::check())
                        @if($prestamo->estado_prestamo == 'abierto')
                            <li @if(Route::is('prestamos.edit')) class="active" @endif>
                                <a href="{{ route('prestamos.edit',$prestamo) }}">Editar</a>
                            </li>
                        @endif
                    @endif

                    @if(session()->get('index'))
                        <li>
                            <a href="{{ url(session()->get('index')) }}">Ver todos los prestamos</a>
                        </li>
                    @else
                        <li>
                            <a href="{{ route('prestamos.index', ['estado'=>'abierto']) }}">Ver todos los prestamos</a>
                        </li>
                    @endif
                </ul>
                <hr>
            </div>
            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">{{ $prestamo->instrumento->nombre }}</div>
                    <div class="panel-body">
                        <dl class="dl-horizontal">
                            <dt>Prestado por:</dt>
                            <dd>{{ $prestamo->usuarioPresta->name }}</dd>

                            <dt>Prestado a:</dt>
                            <dd> {{ $prestamo->usuarioRecibe->name }} </dd>

                            <dt>Laboratorio:</dt>
                            <dd> {{ $prestamo->laboratorio->nombre }} </dd>

                            <dt>Curso:</dt>
                            <dd> {{ $prestamo->curso->nombre }} </dd>

                            <dt>Teléfono de contacto:</dt>
                            <dd> {{ $prestamo->telefono }} </dd>

                            <dt>Mail de contacto:</dt>
                            <dd> <a target="_blank" href="mailto:{{ $prestamo->mail }}">{{ $prestamo->mail }}</a> </dd>

                            <dt>Fecha inicio:</dt>
                            <dd>{{ \Carbon\Carbon::parse($prestamo->created_at)->format("d/m/Y - H:i:s") }}</dd>

                            @if($prestamo->estado_prestamo == 'terminado')
                                <dt>Fecha de fin:</dt>
                                <dd>{{ \Carbon\Carbon::parse($prestamo->updated_at)->format("d/m/Y - H:i:s") }}</dd>
                            @endif
                        </dl>
                        @if($prestamo->estado_prestamo == 'abierto')
                            {{ Form::open(['route'=>['prestamos.update',$prestamo], 'method'=>'PUT']) }}
                            {{ Form::hidden('estado_prestamo', 'terminado') }}
                            {{ Form::submit('Terminar Prestamo', ['class'=>'btn btn-danger pull-right']) }}
                            {{ Form::close() }}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection