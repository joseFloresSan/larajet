@extends('adminlte::page')

@section('title', 'Inventario')

@section('content_header')
    <h1>Inventario</h1>
    <!-- {{ var_dump($reportes) }} -->
    
@stop

@section('content')
<a href="inventario/create" class="btn btn-primary mb-4">Nuevo Registro</a>
<div class="col-lg-12">
    <div class="card">
        <div class="card-body">
            <table id="productos"class="table table-striped table-bordered shadow-lg mt-4" style="width:100%">
                <thead class="bg-primary text-white">
                    <tr>
                        <th scope="col">Fecha</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Costo Por Orden</th>
                        <th scope="col">Costo De Mantenimiento</th>
                        <th scope="col">Unidades Anuales</th>
                        <th scope="col">Unidades Mensuales</th>
                        <th scope="col">Stock</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($reportes as $dataReportes)
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($dataReportes->created_at)->format('d/m/Y') }} </td>
                            <td>{{$dataReportes->nombre}} </td>
                            <td>{{$dataReportes->costoPorOrden}} </td>
                            <td>{{$dataReportes->costoDeMantenimiento}} % </td>
                            <td>{{$dataReportes->unidadesAnuales}} </td>
                            <td>{{$dataReportes->unidadesMensuales}} </td>
                            <td>{{$dataReportes->stockTeorico}} </td>
                            <td>{{$dataReportes->precio}} </td>
                            <td>
                                <!-- <a  href="/inventario/{{$dataReportes->id_reportes}}/edit" class="btn btn-info">Editar</a> -->
                                <a class="btn btn-info mb-4" href="" data-target="#modal-edit-{{$dataReportes->id_reportes}}" data-toggle="modal">Editar</a>
                                <a class="btn btn-danger mb-4" href="" data-target="#modal-delete-{{$dataReportes->id_reportes}}" data-toggle="modal">Borrar</a>
                            
                                <!-- <a  href="/inventario/actu alizar/{{$dataReportes->id_reportes}}" class="btn btn-warning">Actualizar</a> -->
                                <!-- <form action="{{route ('inventario.destroy',$dataReportes->id_reportes)}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Borrar</button>
                                </form> -->
                            </td>

                        </tr>
                        @include('inventario.editModal')
                        @include('inventario.deleteModal')
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>
</div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap5.min.css" rel="stylesheet"> 
@stop

@section('js')
    
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish_Mexico.json"></script>

 <!-- datatables JS -->
 <script type="text/javascript" src="{{asset('datatables/datatables.min.js')}}"></script>    
     
     <!-- para usar botones en datatables JS -->  
     <script src="{{asset('datatables/Buttons-1.5.6/js/dataTables.buttons.min.js')}}"></script>  
     <script src="{{asset('datatables/JSZip-2.5.0/jszip.min.js')}}"></script>    
     <script src="{{asset('datatables/pdfmake-0.1.36/pdfmake.min.js')}}"></script>    
     <script src="{{asset('datatables/pdfmake-0.1.36/vfs_fonts.js')}}"></script>
     <script src="{{asset('datatables/Buttons-1.5.6/js/buttons.html5.min.js')}}"></script>

<script>
$(document).ready(function() {    
    $('#productos').DataTable({        
        language: {
                "lengthMenu": "Mostrar _MENU_ registros",
                "zeroRecords": "No se encontraron resultados",
                "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                "sSearch": "Buscar:",
                "oPaginate": {
                    "sFirst": "Primero",
                    "sLast":"??ltimo",
                    "sNext":"Siguiente",
                    "sPrevious": "Anterior"
			     },
			     "sProcessing":"Procesando...",
            },
        //para usar los botones   
        responsive: "true",
        dom: 'Bfrtilp',       
        buttons:[ 
			{
				extend:    'excelHtml5',
				text:      '<i class="fas fa-file-excel"></i> ',
				titleAttr: 'Exportar a Excel',
				className: 'btn btn-success'
			},
			{
				extend:    'pdfHtml5',
				text:      '<i class="fas fa-file-pdf"></i> ',
				titleAttr: 'Exportar a PDF',
				className: 'btn btn-danger'
			},
			{
				extend:    'print',
				text:      '<i class="fa fa-print"></i> ',
				titleAttr: 'Imprimir',
				className: 'btn btn-info'
			},
		]	        
    });     
});
</script>
@stop