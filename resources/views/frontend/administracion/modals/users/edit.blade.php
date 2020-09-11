<div class="modal fade" id="modalEdit">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Editar Usuarios</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
            <div class="modal-body">
                <!-- form start -->
                <form role="form" action="" method="POST" id="formEdit">
                    <input type="hidden" name="_method" value="PUT">
                    {{ csrf_field() }}
                    <div class="card-body">
                        <div class="form-group">
                            <label>Nombre</label>
                            <input type="text" class="form-control" name="name" placeholder="Nombre ..." id="userName" >
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" class="form-control" name="email" placeholder="Email ..."  id="userEmail">
                        </div> 
                        <div class="form-group">
                            <label>Nueva Contraseña</label>
                            <input type="text" class="form-control" name="password" placeholder="Contraseña ..."  id="userPass">
                        </div> 
                        <div class="form-group">
                            <label>Rol</label>
                            <select class="form-control" name="role" id="roleSelect">
                                <option value="1">user</option>
                                <option value="2">admin</option>
                            </select>
                        </div>             
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        <button  type="submit" class="btn btn-primary" id="btnEdit">Guardar</button>
                    </div>
                </form>
                <!-- /.modal-body -->
            </div>
            <!-- /.form -->
        </div>       
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->