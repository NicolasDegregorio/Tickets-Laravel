  <!-- /.Modal Create Intitution -->
  <div class="modal fade" id="modalCreate">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Intitucion Nueva</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <!-- form start -->
            <form role="form" action="{{url('/institution')}}" method="POST" id="formInstitution">
            {{ csrf_field() }}
                <div class="card-body">
                    <div class="form-group">
                        <label>Nombre</label>
                        <input type="text" class="form-control" name="name" placeholder="Nombre ..." >
                        </div>
                        <div class="form-group">
                        <label>Direccion</label>
                        <input type="text" class="form-control" name="adress" placeholder="Direccion ..." >
                        </div>
                        <div class="form-group">
                        <label>N° CUE</label>
                        <input type="text" class="form-control" name="cue" placeholder="CUE ..." >
                        </div>          
                    </div>                 
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <button  type="submit" class="btn btn-primary">Guardar</button>
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
  <!-- /.Modal Create Intitution -->