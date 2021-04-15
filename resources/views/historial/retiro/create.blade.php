@extends('adminlte::page')

@section('title', 'Historial')

@section('content_header')
    
@stop

@section('content')
<h2>Nuevo Registro</h2>
<form action="/historial"method="POST">
    @csrf
    <div class="row" style="padding:  20px 50px;">
            <div class="col-sm-4">
                <label for="id_empleado" class="form-label">Empleado</label>
                <select class="custom-select" id="id_empleado" name="id_empleado">
                    <option selected>-- Seleccionar Empleado --</option>
                    @foreach($empleados as $dataEmpleado)
                    <option value="{{ $dataEmpleado->id_empleado }}">{{ $dataEmpleado->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-sm-4">
                <label for="id_producto" class="form-label">Producto</label>
                <select class="custom-select" id="id_producto" name="id_producto">
                    <option selected>-- Seleccionar Producto --</option>
                    @foreach($productos as $dataProductos)
                    <option value="{{ $dataProductos->id_producto }}">{{ $dataProductos->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-sm-2">
                <div class="mb-3">
                    <label for="unidadesRetiradas" class ="form-label">Cantidad Retirada</label>
                    <input id="unidadesRetiradas" name="unidadesRetiradas" type="number" class="form-control" placeholder="0 UNITS" tabindex="2">      
                </div>
            </div>

            <div class="col-sm-2">
                <div class="mb-3">
                    <label for="stock" class ="form-label">Stock Restante</label>
                    <input disabled id="stock" name="stock" type="number" class="form-control" placeholder="0 UNITS" tabindex="2">      
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

    <script>
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
                    // $("#unidadesanuales").val(datosProducto.unidadesAnuales);
                }
                    else{
                        $("#stock").val(0);
                        // $("#unidadesanuales").val(0);
                    }
        });
    });

    
    $(document).ready(function(){
        var stock = $("#stock").val();
        var cont = 0;
        $("#id_producto").change(function(){
            cont = 0;
        });    
        
        $("#unidadesRetiradas").keyup(function(){
            
            if(cont == 0){
         stock = $("#stock").val();

            }
                var unidadesRetiro =  $(this).val();
                var newStock = stock - unidadesRetiro;
                $("#stock").val(newStock);
                
            cont++;
            
        });
    });
    </script>
@stop