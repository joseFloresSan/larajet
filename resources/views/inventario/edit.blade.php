@extends('adminlte::page')

@section('title', 'Editar Producto')

@section('content_header')
    
@stop

@section('content')
<h2>Editar Registro de Inventario</h2>

<form  action="/inventario/{{$reporte->id_reportes}}"method="POST">
    @csrf
    @method ('PUT')
        <div class="row d-flex justify-content-between">
            <div class="col-sm-3">
                <label for="id_producto" class="form-label">Inventario</label>
                <select class="custom-select" id="id_producto" name="id_producto">
                    <option selected>-- Seleccionar Producto --</option>
                    @foreach($productos as $dataProductos)
                        @if ($dataProductos->id_producto == $reporte->id_producto)
                        <option selected value="{{ $dataProductos->id_producto }}">{{ $dataProductos->nombre }}</option>
                        @continue
                        @endif
                        <option value="{{ $dataProductos->id_producto }}">{{ $dataProductos->nombre }}</option>
                    
                    @endforeach
                </select>
            </div>

            <div class="col-sm-3">
                <div class="mb-3">
                    <label for="" class="form-label">Costo por Orden</label>
                    <input id="costopororden" name="costopororden" type="number" step="any" class="form-control" value="{{$reporte->costoPorOrden}}" tabindex="3" >
                </div>
            </div>

            <div class="col-sm-3">
                <div class="mb-3">
                    <label for="" class="form-label">Costo de Mantenimiento</label>
                    <input  id="costodemantenimiento" name="costodemantenimiento" type="number" step="any" value="{{$reporte->costoDeMantenimiento}}" placeholder="0.00 %" class="form-control" tabindex="4">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-3">
                <div class="mb-3">
                    <label for="unidadesmensuales" class="form-label">Unidades Mensuales</label>
                    <input id="unidadesmensuales" name="unidadesmensuales" type="number" value="{{$reporte->unidadesMensuales}}" class="form-control" tabindex="6">
                </div>
            </div>
            <div class="col-sm-3">
                <div class="mb-3">
                    <label for="stock" class="form-label">Stock</label>
                    <input readonly id="stock" name="stock" type="number" value="{{$reporte->stockTeorico}}"class="form-control" tabindex="7">
                </div>
            </div>
            <div class="col-sm-3" >
                <div class="mb-3" >
                    <label for="" class="form-label" style="display: block;">Unidades Anuales</label>
                    <input readonly id="unidadesanuales" name="unidadesanuales" value="{{$reporte->unidadesAnuales}}" type="number" class="form-control" tabindex="5" style="display: inline-block; width:100px;">
                    <a  class="form-control btn btn-success" id="btnUnidadesAnuales" style="display: inline-block; width:50px; margin-bottom:6px"><i class="far fa-edit"></i></a>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="mb-3">
                    <label for="precio" class="form-label">Precio</label>
                    <input id="precio" name="precio" type="number" step="any" value="{{$reporte->precio}}" placeholder="S/.   0.00" class="form-control" tabindex="8">
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