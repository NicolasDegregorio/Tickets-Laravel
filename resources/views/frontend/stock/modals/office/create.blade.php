  <!-- /.Modal Create Stock -->
  <div class="modal fade" id="modalCreate">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Oficina Nueva</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <!-- form start -->
            <form role="form" action="{{url('/office')}}" method="POST" id="formOffice">
            {{ csrf_field() }}
                <div class="card-body">
                    <div class="form-group">
                      <label>Nombre</label>
                      <input type="text" class="form-control" name="name" placeholder="Nombre ..." >
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