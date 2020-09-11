<!-- /.Modal Create user -->
<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Usuario Nuevo</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <!-- form start -->
        <form role="form" action="{{url('/users/create')}}" method="POST" id="formUser">
          {{ csrf_field() }}
                <div class="card-body">
                  <div class="form-group">
                    <label>Nombre</label>
                    <input type="text" class="form-control" name="name" placeholder="Nombre ..." >
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Email</label>
                    <input type="email" class="form-control" name="email" placeholder="Email">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Contraseña</label>
                    <input type="password" class="form-control" name="password" id="password" placeholder="Contraseña">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Repetir Contraseña</label>
                    <input type="password" class="form-control" name="password_confirmation" placeholder="Repetir Contrseña">
                  </div>  
                  <div class="form-group">
                    <label>Rol</label>
                    <select class="form-control" name="role">
                      <option value="1">User</option>
                      <option value="2">Admin</option>
                    </select>
                  </div>  
                    
                </div>
                <div class="modal-footer justify-content-between">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                  <button  type="submit" class="btn btn-primary">Crear Usuario</button>
                </div>
              </div>
            </form>
        <!-- /.form -->
        </div>
        
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->