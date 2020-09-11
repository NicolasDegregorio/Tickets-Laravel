<div class="modal fade" id="modalEdit">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Editar Ticket</h4>
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
                        <label>Responsable</label>
                        <select class="form-control" name="userId" id="selectUser">
                          @foreach ($users as $user)
                            <option value="{{$user->id}}" >
                              {{$user->name}}
                            </option>
                          @endforeach
                        </select>
                      </div>
                    <div class="form-group">
                        <div class="form-group">
                            <label>Establecimiento</label>
                            <select class="form-control"  name="institution" id="institutionSelect">
                              @foreach ($institutions as $institution)
                              <option value="{{$institution->id}}">
                                {{$institution->name}}
                              </option>
                              @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                      <label>Fecha de Inicio</label>
                      <input id="start_date" width="270"  name="start_date" autocomplete="off"/>  
                    </div> 
                    <div class="form-group">
                      <label>Fecha Limite</label>
                      <input id="end_date" width="270" / name="end_date" autocomplete="off">  
                    </div>                     
                    <!-- radio -->
                    <div class="form-group">
                      <div> 
                        <label> Prioridad </label>
                      </div>
                      @foreach ($priorities as $priority)
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" value="{{$priority->id}}" id="{{$priority->name}}" name="priority">
                          <label class="form-check-label" name="priority">{{$priority->name}}</label>
                        </div>
                      @endforeach   
                      <div class="form-group">
                        <label>Problematica</label>
                        <textarea class="form-control" rows="3" placeholder="Escribir ..." name="description" id="descriptionText"></textarea>
                      </div>                     
                    </div>                   
                </div>
                <div class="modal-footer justify-content-between">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                  <button  type="submit" class="btn btn-primary" id="btnEdit">Guardar</button>
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