@extends('adminlte::page')

@section('title', 'Editar Producto')

@section('content_header')
    
@stop

@section('content')
<h2>Editar Producto</h2>
<form action="/producto/{{$producto->id_producto}}"method="POST">
    @csrf
    @method ('PUT')
    <div class="row">
        <div class="col-sm-6">
            <div class="mb-3">
                <label for="" class ="form-label">Codigo</label>
                <input id="codigo" name="codigo" type="text" class="form-control" value="{{$producto->codigo}}">      
            </div>
        </div>
        <div class="col-sm-6">
            <div class="mb-3">
                <label for="" class ="form-label">Nombre</label>
                <input id="nombre" name="nombre" type="text" class="form-control" value="{{$producto->nombre}}">      
            </div>
        </div>
    </div>
    
    
    <div class="row">
        <div class="col-sm-12 d-flex justify-content-center">
            <a href="/productos" class="btn btn-secondary" tabindex="9">Cancelar</a> &nbsp;&nbsp;
            <button type="submit" class="btn btn-primary" tabindex="10">Guardar</button>
        </div>
    </div>
    
    
    
   
    
</form>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')

@stop