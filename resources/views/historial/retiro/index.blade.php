@extends('adminlte::page')

@section('title', 'Inventario')

@section('content_header')
    <h1>Historial de Retiro</h1>
@stop

@section('content')
<a class="btn btn-info mb-4" href="" data-target="#modal-create-retiro-producto" data-toggle="modal"> Retirar Producto </a>
    @include('historial.retiro.createModal')
<div class="col-lg-12">
    <div class="card">
        <div class="card-body">
            <table id="productos"class="table table-striped table-bordered shadow-lg mt-4" style="width:100%">
                <thead class="bg-primary text-white">
                    <tr>
                        <th scope="col">Fecha</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Producto</th>
                        <th scope="col">Unidades Retiradas</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($historial as $dataHistorial)
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($dataHistorial->created_at)->format('d/m/Y') }} </td>
                            <td>{{$dataHistorial->empleado}} </td>
                            <td>{{$dataHistorial->producto}} </td>
                            <td>{{$dataHistorial->unidadesRetiradas}} </td>
                            <td>
                            <a class="btn btn-info mb-4" href="" data-target="#modal-edit-{{$dataHistorial->id_historial}}" data-toggle="modal">Editar</a>
                            <a class="btn btn-danger mb-4" href="" data-target="#modal-delete-{{$dataHistorial->id_historial}}" data-toggle="modal">Borrar</a>

                                <!-- <form action="{{route ('historial.destroy',$dataHistorial->id_historial)}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Borrar</button>
                                </form> -->
                            </td>
                        </tr>
                        @include('historial.retiro.editModal')
                        @include('historial.retiro.deleteModal')
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
                    "sLast":"Último",
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