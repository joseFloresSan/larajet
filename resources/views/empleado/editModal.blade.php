<div class="modal fade" aria-hidden="true" role="dialog" tabindex="-1" id="modal-edit-{{$empleado->id_empleado}}">
    <div class="modal-dialog modal-dialog-centered" role="document">
        
        <form action="/empleados/{{$empleado->id_empleado}}"method="POST">
            @csrf
            @method('put')
            <div class="modal-content">
                <div class="modal-header" style="background-color: rgb(40, 117, 162);">
                    <h4 class="modal-title" style="color:white;">Registrar Empleado</h4>
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
                            <div class="mb-3">
                                <label for="" class ="form-label">DNI</label>
                                <input value="{{$empleado->dni}}" id="dni" name="dni" type="number" class="form-control" tabindex="1">      
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="" class ="form-label">Nombre</label>
                                <input value="{{$empleado->nombre}}" id="nombre" name="nombre" type="text" class="form-control" tabindex="2">      
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="" class ="form-label">Celular</label>
                                <input value="{{$empleado->celular}}" id="celular" name="celular" type="number" class="form-control" tabindex="3">      
                            </div>   
                        </div>

                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="" class ="form-label">Direccion</label>
                                <input value="{{$empleado->direccion}}" id="direccion" name="direccion" type="text" class="form-control" tabindex="4">      
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