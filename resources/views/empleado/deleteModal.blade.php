<div class="modal fade" aria-hidden="true" role="dialog" tabindex="-1" id="modal-delete-{{$empleado->id_empleado}}">
    <div class="modal-dialog modal-dialog-centered" role="document">  
        <form  action="{{route ('empleados.destroy',$empleado->id_empleado)}}" method="POST">
            @csrf
            @method("DELETE")
            <div class="modal-content">
                <div class="modal-header" style="background-color: rgb(40, 117, 162);">
                    <h4 class="modal-title" style="color:white;">Eliminar Empleado</h4>
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
                    <div class="form-group">
                        <p>Esta seguro que desea eliminar a "{{$empleado->nombre}}" ?</p>   
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal" >Cerrar</button>
                    <button type="submit" class="btn btn-primary">Confirmar</button>
                </div>
            </div>
        </form>
    </div>
</div> 