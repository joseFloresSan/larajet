@extends('adminlte::page')

@section('title', 'Crear Producto')

@section('content_header')
<h2>Registrar en Inventario</h2>
@stop

@section('content')
<div class="container" style="padding: 10px 50px;">
    
    <form action="/inventario" method="POST">
        @csrf
        <div class="row d-flex justify-content-between">
            <div class="col-sm-3">
                <label for="id_producto" class="form-label">Productos</label>
                <select class="custom-select" id="id_producto" name="id_producto">
                    <option selected>-- Seleccionar Producto --</option>
                    @foreach($productos as $dataProductos)
                    <option value="{{ $dataProductos->id_producto }}">{{ $dataProductos->nombre }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-sm-3">
                <div class="mb-3">
                    <label for="" class="form-label">Costo por Orden</label>
                    <input id="costopororden" name="costopororden" type="number" step="any" class="form-control" tabindex="3" >
                </div>
            </div>

            <div class="col-sm-3">
                <div class="mb-3">
                    <label for="" class="form-label">Costo de Mantenimiento</label>
                    <input  id="costodemantenimiento" name="costodemantenimiento" type="number" step="any" placeholder="0.00 %" class="form-control" tabindex="4">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-3">
                <div class="mb-3">
                    <label for="" class="form-label">Unidades Mensuales</label>
                    <input id="unidadesmensuales" name="unidadesmensuales" type="number" class="form-control" tabindex="6">
                </div>
            </div>
            <div class="col-sm-3">
                <div class="mb-3">
                    <label for="" class="form-label">Stock</label>
                    <input disabled id="stock" name="stock" type="number" class="form-control" tabindex="7">
                </div>
            </div>
            <div class="col-sm-3" >
                <div class="mb-3" >
                    <label for="" class="form-label">Unidades Anuales</label>
                    <input disabled id="unidadesanuales" name="unidadesanuales" type="number" class="form-control" tabindex="5" style="display: inline-block; width:100px;">
                    <a  class="form-control btn btn-success" id="btnUnidadesAnuales" style="display: inline-block; width:50px; margin-bottom:6px"><i class="far fa-edit"></i></a>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="mb-3">
                    <label for="" class="form-label">Precio</label>
                    <input id="precio" name="precio" type="number" step="any" placeholder="S/.   0.00" class="form-control" tabindex="8">
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
</div>
@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')

<script>
    var inputUnidadesAnuales = document.getElementById('unidadesanuales');
    document.getElementById('btnUnidadesAnuales').addEventListener('click', function(e){
        console.log("habilitando elemento btnUnidadesAnuales");
        inputUnidadesAnuales.disabled = false;
        inputUnidadesAnuales.focus();
    });

    $("#id_producto").change(function() {
        var id_producto = $("#id_producto").val();
        console.log(id_producto);

        $.ajax({
            url: '/inventario/getStockAnualUnits',
            method:'POST',
            data:{
                id: id_producto,
                _token:$('input[name="_token"]').val()
            }
        }).done(function(res){   
            
                console.log(res);
                if(res !== "null"){
                    var datosProducto = JSON.parse(res)

                    $("#stock").val(datosProducto.stockTeorico);
                    $("#unidadesanuales").val(datosProducto.unidadesAnuales);
                }
                    else{
                        $("#stock").val(0);
                        $("#unidadesanuales").val(0);
                    }
                    
        });
    });
</script>

@stop