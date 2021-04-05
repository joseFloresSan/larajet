@extends('adminlte::page')

@section('title', 'Editar Empleado')

@section('content_header')
    
@stop

@section('content')
<h2>Editar Empleado</h2>
<form action="/empleados/{{$empleado->id}}"method="POST">
    @csrf
    @method ('PUT')
    <div class="mb-3">
        <label for="" class ="form-label">DNI</label>
        <input id="dni" name="dni" type="number" class="form-control" value="{{$empleado->dni}}">      
    </div>
    <div class="mb-3">
        <label for="" class ="form-label">Nombre</label>
        <input id="nombre" name="nombre" type="text" class="form-control" value="{{$empleado->nombre}}">      
    </div>
    <div class="mb-3">
        <label for="" class ="form-label">Celular</label>
        <input id="celular" name="celular" type="number" class="form-control" value="{{$empleado->celular}}">      
    </div>
    <div class="mb-3">
        <label for="" class ="form-label">Direccion</label>
        <input id="direccion" name="direccion" type="text" class="form-control" value="{{$empleado->direccion}}">      
    </div>
    <a href="/empleados" class="btn btn-secondary" tabindex="5">Cancelar</a>
    <button type="submit" class="btn btn-primary" tabindex="6">Guardar</button>
    
</form>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')

@stop