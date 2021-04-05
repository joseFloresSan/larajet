@extends('adminlte::page')

@section('title', 'Crear Producto')

@section('content_header')
    
@stop

@section('content')
<h2>Crear Producto</h2>
<form action="/productos"method="POST">
    @csrf
    <div class="row">
        <div class="col-sm-6">
            <div class="mb-3">
                <label for="" class ="form-label">Codigo</label>
                <input id="codigo" name="codigo" type="text" class="form-control" tabindex="1">      
            </div>
        </div>

        <div class="col-sm-6">
            <div class="mb-3">
                <label for="" class ="form-label">Nombre</label>
                <input id="nombre" name="nombre" type="text" class="form-control" tabindex="2">      
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-sm-4">
            <div class="mb-3"> 
                <label for="" class ="form-label">Costo Por Orden</label>
                <input id="costopororden" name="costopororden" type="number" step="any" class="form-control" tabindex="3">      
            </div> 
        </div>

        <div class="col-sm-4">
            <div class="mb-3">
                <label for="" class ="form-label">Costo De Mantenimiento</label>
                <input id="costodemantenimiento" name="costodemantenimiento" type="number" step="any" class="form-control" tabindex="4">      
            </div>
        </div>
        <div class="col-sm-4">
            <div class="mb-3">
                <label for="" class ="form-label">Unidades Anuales</label>
                <input id="unidadesanuales" name="unidadesanuales" type="number" class="form-control" tabindex="5">      
            </div>
        </div>
    </div>
       
    
    <div class="row">
        <div class="col-sm-4">
            <div class="mb-3">
                <label for="" class ="form-label">Unidades Mensuales</label>
                <input id="unidadesmensuales" name="unidadesmensuales" type="number" class="form-control" tabindex="6">      
            </div>
        </div>

        <div class="col-sm-4">
            <div class="mb-3">
                <label for="" class ="form-label">Stock</label>
                <input id="stock" name="stock" type="number" class="form-control" tabindex="7">      
            </div>
        </div>

        <div class="col-sm-4">
            <div class="mb-3">
                <label for="" class ="form-label">Precio</label>
                <input id="precio" name="precio" type="number" step="any" value="0.00"class="form-control" tabindex="8">      
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