@extends('adminlte::page')

@section('title', 'Crear Empleado')

@section('content_header')
    
@stop

@section('content')
<h2>Crear Empleado</h2>
<form action="/empleados"method="POST">
    @csrf
    <div class="mb-3">
        <label for="" class ="form-label">DNI</label>
        <input id="dni" name="dni" type="number" class="form-control" tabindex="1">      
    </div>
    <div class="mb-3">
        <label for="" class ="form-label">Nombre</label>
        <input id="nombre" name="nombre" type="text" class="form-control" tabindex="2">      
    </div>
    <div class="mb-3">
        <label for="" class ="form-label">Celular</label>
        <input id="celular" name="celular" type="number" class="form-control" tabindex="3">      
    </div>    
    <div class="mb-3">
        <label for="" class ="form-label">Direccion</label>
        <input id="direccion" name="direccion" type="text" class="form-control" tabindex="4">      
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