<div class="modal fade" aria-hidden="true" role="dialog" tabindex="-1" id="modal-edit-{{$dataReportes->id_reportes}}">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">   
        <form action="/inventario/{{$dataReportes->id_reportes}}"method="POST">
            @csrf
            @method ('PUT')
            <div class="modal-content">
                <div class="modal-header" style="background-color: rgb(40, 117, 162);">
                    <h4 class="modal-title" style="color:white;">Editar Registro Inventario</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" style="color:white;">x</span>
                    </button>
                </div>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                <div class="modal-body">
                    <div class="row d-flex justify-content-between">
                        <div class="col-sm-3">
                            <div class="mb-3">
                                <label for="id_producto" class="form-label">Producto</label>
                                <input readonly value="{{$dataReportes->nombre}}" id="id_producto" name="id_producto" type="text" class="form-control" tabindex="1">         
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="mb-3">
                                <label for="" class="form-label">Costo por Orden</label>
                                <input value="{{$dataReportes->costoPorOrden}}" id="costopororden" name="costopororden" type="number" step="any" class="form-control" tabindex="3" >
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="mb-3">
                                <label for="" class="form-label">Costo de Mantenimiento</label>
                                <input value="{{$dataReportes->costoDeMantenimiento}}"  id="costodemantenimiento" name="costodemantenimiento" type="number" step="any"  placeholder="0.00 %" class="form-control" tabindex="4">
                            </div>
                        </div>
                    </div>  

                    <div class="row">
                        <div class="col-sm-3">
                            <div class="mb-3">
                                <label for="unidadesmensuales" class="form-label">Unidades Mensuales</label>
                                <input value="{{$dataReportes->unidadesMensuales}}" id="unidadesmensuales" name="unidadesmensuales" type="number" class="form-control" tabindex="6">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="mb-3">
                                <label for="stock" class="form-label">Stock</label>
                                <input value="{{$dataReportes->stockTeorico}}" readonly id="stock" name="stock" type="number" class="form-control" tabindex="7">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="mb-3" >
                                <label for="" class="form-label" style="display: block;">Unidades Anuales</label>
                                <input id="unidadesanuales" name="unidadesanuales" value="{{$dataReportes->unidadesAnuales}}" type="number" class="form-control" tabindex="5" style="display: inline-block; width:100px;">
                                <!-- <a  class="form-control btn btn-success" id="btnUnidadesAnuales" style="display: inline-block; width:50px; margin-bottom:6px"><i class="far fa-edit"></i></a> -->
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="mb-3">
                                <label for="precio" class="form-label">Precio</label>
                                <input value="{{$dataReportes->precio}}" id="precio" name="precio" type="number" step="any" placeholder="S/.   0.00" class="form-control" tabindex="8">
                            </div>
                        </div>
                    </div>                    
                </div>
                <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary" data-dismiss="modal" >Cerrar</button>
                            <button type="submit" class="btn btn-primary">Confirmar</button>
                </div>
            </div>
        </form>
    </div>
</div>


<!-- <script src="">
var inputUnidadesAnuales = document.getElementById('unidadesanuales');
    document.getElementById('btnUnidadesAnuales').addEventListener('click', function(e){
        console.log("habilitando elemento btnUnidadesAnuales");
        inputUnidadesAnuales.readOnly = false;
        inputUnidadesAnuales.focus();
    });
</script> -->
