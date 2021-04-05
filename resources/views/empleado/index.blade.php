@extends('adminlte::page')

@section('title', 'Empleados')

@section('content_header')
    <h1>Lista de Empleados</h1>
@stop

@section('content')
<a href="empleados/create" class="btn btn-primary mb-4">Crear Empleado</a>

<table id="empleados"class="table table-striped table-bordered shadow-lg mt-4" style="width:100%">
    <thead class="bg-primary text-white">
        <tr>
            <th scope="col">ID</th>
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
                <td>{{$empleado->id}} </td>
                <td>{{$empleado->dni}} </td>
                <td>{{$empleado->nombre}} </td>
                <td>{{$empleado->celular}} </td>
                <td>{{$empleado->direccion}} </td>
                
                <td>
                    <form action="{{route ('empleados.destroy',$empleado->id)}}" method="POST">
                    <a  href="/empleados/{{$empleado->id}}/edit" class="btn btn-info">Editar</a>
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Borrar</button>
                    </form>
                </td>

            </tr>
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