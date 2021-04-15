<div class="modal fade" aria-hidden="true" role="dialog" tabindex="-1" id="modal-edit-{{$dataHistorial->id_historial}}">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">   
        <form action="/historial/{{$dataHistorial->id_historial}}"method="POST">
            @csrf
            @method ('PUT')
            <div class="modal-content">
                <div class="modal-header" style="background-color: rgb(40, 117, 162);">
                    <h4 class="modal-title" style="color:white;">Editar Historial de Retiro</h4>
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
                    <div class="row">
                        <div class="col-sm-6">
                            <label for="id_empleado" class="form-label">Empleado</label>
                            <select class="custom-select" id="id_empleado" name="id_empleado">
                                <option selected>-- Seleccionar Empleado --</option>
                                @foreach($empleados as $dataEmpleado)
                                    @if($dataEmpleado->id_empleado == $dataHistorial->id_empleado)
                                        <option selected value="{{ $dataEmpleado->id_empleado }}">{{ $dataEmpleado->nombre }}</option>
                                        @continue
                                    @endif
                                        <option value="{{ $dataEmpleado->id_empleado }}">{{ $dataEmpleado->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <label for="id_producto" class="form-label">Producto</label>
                            <select class="custom-select" id="id_producto" name="id_producto">
                                <option selected>-- Seleccionar Producto --</option>
                                @foreach($productos as $dataProductos)
                                    @if ($dataProductos->id_producto == $dataHistorial->id_producto)
                                        <option selected value="{{ $dataProductos->id_producto }}">{{ $dataProductos->nombre }}</option>
                                        @continue
                                    @endif
                                        <option value="{{ $dataProductos->id_producto }}">{{ $dataProductos->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>  

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="mb-3">
                                <label for="unidadesRetiradas" class ="form-label">Cantidad Retirada</label>
                                <input value="{{ $dataHistorial->unidadesRetiradas }}" id="unidadesRetiradas" name="unidadesRetiradas" type="number" class="form-control" placeholder="0 UNITS" tabindex="2">      
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
