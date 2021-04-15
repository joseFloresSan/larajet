@extends('adminlte::page')

@section('title', 'Empleados')

@section('content_header')
    <h1>Lista de Empleados</h1>
@stop
@section('content')
<a class="btn btn-info mb-4" href="" data-target="#modal-create-empleado" data-toggle="modal">Crear Empleado</a>

@include('empleado.modalCreate')
<table id="empleados"class="table table-striped table-bordered shadow-lg mt-4" style="width:100%">
    <thead class="bg-primary text-white">
        <tr>
            <!-- <th scope="col">ID</th> -->
            <th scope="col">DNI</th>
            <th scope="col">Nombre</th>
            <th scope="col">Celular</th>
            <th scope="col">Direccion</th>
            <th scope="col">Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($empleados as $empleado)
            <tr>
                <!-- <td>{{$empleado->id_empleado}} </td> -->
                <td>{{$empleado->dni}} </td>
                <td>{{$empleado->nombre}} </td>
                <td>{{$empleado->celular}} </td>
                <td>{{$empleado->direccion}} </td>
                <td>
                    <a class="btn btn-info mb-4" href="" data-target="#modal-edit-{{$empleado->id_empleado}}" data-toggle="modal">Editar</a>
                    <a class="btn btn-danger mb-4" href="" data-target="#modal-delete-{{$empleado->id_empleado}}" data-toggle="modal">Eliminar</a>
                </td>

            </tr>
            @include('empleado.editModal')
            @include('empleado.deleteModal')
        @endforeach
    </tbody>

</table>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap5.min.css" rel="stylesheet"> 
@stop

@section('js')
    
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap5.min.js"></script>
<script>
$(document).ready(function() {
    $('#empleados').DataTable();
} );
</script>
@stop