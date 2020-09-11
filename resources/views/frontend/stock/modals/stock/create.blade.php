  <!-- /.Modal Create Stock -->
  <div class="modal fade" id="modalCreate">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Stock Nuevo</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <!-- form start -->
            <form role="form" action="{{url('/stock')}}" method="POST" id="formStock">
            {{ csrf_field() }}
                <div class="card-body">
                    <div class="form-group">
                        <label>Nombre</label>
                        <input type="text" class="form-control" name="name" placeholder="Nombre ..." >
                    </div>
                    <div class="form-group">
                      <label>Cantidad</label>
                      <input type="text" class="form-control" name="quantity" placeholder="Cantidad ..." >
                    </div>
                    <div class="form-group">
                      <label>Categoria</label>
                      <select class="form-control"  name="category">
                        @foreach ($categories as $category)
                        <option value="{{$category->id}}">
                          {{$category->name}}
                        </option>
                        @endforeach
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Oficina</label>
                      <select class="form-control"  name="office">
                        @foreach ($offices as $office)
                        <option value="{{$office->id}}">
                          {{$office->name}}
                        </option>
                        @endforeach
                      </select>
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