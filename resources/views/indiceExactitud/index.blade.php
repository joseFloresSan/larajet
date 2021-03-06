@extends('adminlte::page')

@section('title', 'Inventario')

@section('content_header')
    <h1>Costo de Pedido</h1>
@stop

@section('content')
<div class="col-lg-12">
    <div class="card">
        <div class="card-body">
            <table id="costodeconservacions"class="table table-striped table-bordered shadow-lg mt-4" style="width:100%">
                <thead class="bg-primary text-white">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">Codigo</th>
                        <th scope="col">Nombre</th>            
                        <th scope="col">Stock Teorico</th>
                        <th scope="col">Stock Real</th>
                        <th scope="col">Indice de Exactitud</th>
                        
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($indiceExactitud as $dataIndiceExactitud)
                        <tr>
                            <td>{{$dataIndiceExactitud->id_producto}} </td>
                            <td>{{ \Carbon\Carbon::parse($dataIndiceExactitud->created_at)->format('d/m/Y') }} </td>
                            <td>{{$dataIndiceExactitud->codigo}} </td>
                            <td>{{$dataIndiceExactitud->nombre}} </td>                
                            <td>{{$dataIndiceExactitud->stockTeorico}} </td>
                            <td>{{$dataIndiceExactitud->stockReal}} </td>
                            <td>{{$dataIndiceExactitud->indiceExactitud}}</td>       
                            <td>
                                <!-- <form action="{{route ('costodeconservacions.destroy',$dataIndiceExactitud->id_producto)}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Borrar</button>
                                </form> -->
                                <a href="" data-target="#modal-edit-{{$dataIndiceExactitud->id_producto}}" data-toggle="modal">
                                    <button class="btn btn-success">
                                        <i class="fas fa-edit"></i>
                                        Stock Real
                                    </button>
                                </a>
                            </td>
                        
                        </tr>

                        @include('indiceExactitud.modalStockReal')
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
    $('#costodeconservacions').DataTable({        
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