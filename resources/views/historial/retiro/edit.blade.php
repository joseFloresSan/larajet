@extends('adminlte::page')

@section('title', 'Editar Producto')

@section('content_header')
    
@stop

@section('content')
<h2>Editar historial de retiro</h2>


<form action="/historial/{{$historial->id_historial}}"method="POST">
    @csrf
    @method ('PUT')
    <div class="row" style="padding:  20px 50px;">
            <div class="col-sm-4">
                <label for="id_empleado" class="form-label">Empleado</label>
                <select class="custom-select" id="id_empleado" name="id_empleado">
                    <option selected>-- Seleccionar Empleado --</option>
                    @foreach($empleados as $dataEmpleado)
                        @if($dataEmpleado->id_empleado == $historial->id_empleado)
                            <option selected value="{{ $dataEmpleado->id_empleado }}">{{ $dataEmpleado->nombre }}</option>
                            @continue
                        @endif
                            <option value="{{ $dataEmpleado->id_empleado }}">{{ $dataEmpleado->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-sm-4">
                <label for="id_producto" class="form-label">Producto</label>
                <select class="custom-select" id="id_producto" name="id_producto">
                    <option selected>-- Seleccionar Producto --</option>
                    @foreach($productos as $dataProductos)
                        @if ($dataProductos->id_producto == $historial->id_producto)
                            <option selected value="{{ $dataProductos->id_producto }}">{{ $dataProductos->nombre }}</option>
                            @continue

                        @endif
                            <option value="{{ $dataProductos->id_producto }}">{{ $dataProductos->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-sm-4">
                <div class="mb-3">
                    <label for="unidadesRetiradas" class ="form-label">Cantidad Retirada</label>
                    <input value="{{ $historial->unidadesRetiradas }}" id="unidadesRetiradas" name="unidadesRetiradas" type="number" class="form-control" placeholder="0 UNITS" tabindex="2">      
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