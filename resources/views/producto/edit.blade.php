@extends('adminlte::page')

@section('title', 'Editar Producto')

@section('content_header')
    
@stop

@section('content')
<h2>Editar Producto</h2>
<form action="/productos/{{$producto->id_producto}}"method="POST">
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
        <div class="col-sm-4">
            <div class="mb-3">
                <label for="" class ="form-label">Costo Por Orden</label>
                <input id="costopororden" name="costopororden" type="number" class="form-control" value="{{$producto->costoPorOrden}}">      
            </div>
        </div>

        <div class="col-sm-4">
            <div class="mb-3">
                <label for="" class ="form-label">Costo De Mantenimiento</label>
                <input id="costodemantenimiento" name="costodemantenimiento" type="number" class="form-control" value="{{$producto->costoDeMantenimiento}}">      
            </div>
        </div>

        <div class="col-sm-4">
            <div class="mb-3">
                <label for="" class ="form-label">Unidades Anuales</label>
                <input id="unidadesanuales" name="unidadesanuales" type="number" class="form-control" value="{{$producto->unidadesAnuales}}">      
            </div>
        </div>
    </div>
    
    <div class="row">
        
        <div class="col-sm-4">
            <div class="mb-3">
                <label for="" class ="form-label">Unidades Mensuales</label>
                <input id="unidadesmensuales" name="unidadesmensuales" type="number" class="form-control" value="{{$producto->unidadesMensuales}}">      
            </div>
        </div>

        <div class="col-sm-4">
            <div class="mb-3">
                <label for="" class ="form-label">Stock</label>
                <input id="stock" name="stock" type="number" class="form-control" value="{{$producto->stockTeorico}}">      
            </div>
        </div>

        <div class="col-sm-4">
            <div class="mb-3">
                <label for="" class ="form-label">Precio</label>
                <input id="precio" name="precio" type="number" step="any" value="0.00"class="form-control" value="{{$producto->precio}}">      
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