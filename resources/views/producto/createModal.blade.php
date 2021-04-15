<div class="modal fade" aria-hidden="true" role="dialog" tabindex="-1" id="modal-create-producto">
    <div class="modal-dialog modal-dialog-centered" role="document">   
        <form action="/producto"method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header" style="background-color: rgb(40, 117, 162);">
                    <h4 class="modal-title" style="color:white;">Registrar Producto</h4>
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
                                <label for="" class ="form-label">Codigo</label>
                                <input id="codigo" name="codigo" type="text" class="form-control" tabindex="1">      
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="" class ="form-label">Nombre</label>
                                <input id="nombre" name="nombre" type="text" class="form-control" tabindex="2">      
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