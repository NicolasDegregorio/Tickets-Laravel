@extends('frontend.master')
@section('stylus')
    @notify_css
    <link rel="stylesheet" href={{ asset('AdminLTE/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}>
    <link rel="stylesheet" href={{ asset('AdminLTE/plugins//select2/css/select2.min.css') }}>
@endsection

@section('content_frontend')
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Detalles del Ticket</h3>
                <div class="card-tools">
                    
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        @if ( $ticket_user->contains('user_id', auth()->user()->id))
                            <button class="btn btn-primary mb-2" id="addTeam"> Agregar al Equipo </button>
                        @endif
                        <div class="col-md-6" id="team">
                            <div class="form-group">
                                <form action="{{ url('/add_user_team') }}" id="formAddTeam" method="POST">
                                    {{ csrf_field() }}
                                    <input id="ticketId" name="ticketId" type="hidden" value="{{$ticket->id}}">
                                    <select class="select2bs4" multiple="multiple" name="usersTicket[]" data-placeholder="Agregar Usuario al Ticket"
                                    style="width: 100%;">
                                        @foreach ($users as $user)
                                            <option value="{{$user->id}}">{{$user->name}}</option>
                                        @endforeach
                                    </select>
                                    <button type="submit" class="btn btn-primary my-2 btnaAddTeam">Agregar</button>
                                </form>
                            </div>
                        </div> 
                    </div>
                    <div class="col-12 col-md-12 col-lg-8 order-2 order-md-1">
                        <div class="row">
                            <div class="col-12 col-sm-4">
                                <div class="info-box bg-light">
                                    <div class="info-box-content">
                                        <span class="info-box-text text-center text-muted">Fecha de Inicio</span>
                                        <span class="info-box-number text-center text-muted mb-0">{{$ticket->start_date}}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-4">
                                <div class="info-box bg-light">
                                    <div class="info-box-content">
                                        <span class="info-box-text text-center text-muted">Fecha Limite</span>
                                        <span class="info-box-number text-center text-muted mb-0">{{$ticket->end_date}}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-4">
                                <div class="info-box bg-light">
                                    <div class="info-box-content">
                                        <span class="info-box-text text-center text-muted">Estado</span>
                                        <span class="info-box-number text-center text-muted mb-0">
                                            @if ($ticket->state->name === 'Completado')
                                                <span class="badge badge-success" id="badge">Resuelto</span>
                                            @elseif ($ticket->state->name === 'En Progreso')
                                            <span class="badge badge-warning" id="badge">En Progreso</span>
                                            @elseif ($ticket->state->name === 'Sin Resolver')
                                                <span class="badge badge-danger" id="badge">Sin Resolver</span>
                                            @endif
                                        <span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <h4>Mensaje</h4>
                                <form action="{{ url('message') }}" method="POST">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <input type="hidden" name="ticket_id" value="{{$ticket->id}}">
                                        <textarea class="form-control" rows="3" name="message" placeholder="Escribir Mensaje ..."></textarea>
                                        <button type="submit" class="btn btn-primary my-1">Enviar</button>
                                    </div>
                                </form>
                                <h4>Actividad Reciente</h4>
                                @foreach ($ticket->message as $message)
                                    <div class="post">
                                        <div class="user-block">
                                            <img class="img-circle img-bordered-sm" src="{{ asset('AdminLTE//dist/img/user1-128x128.jpg') }}" alt="user image">
                                            <span class="username">
                                                <a href="#">{{$message->user->name}}
                                                    @if ($responsible === $message->user->name)
                                                        <span class="badge badge-success">Responsable</span>
                                                    @endif
                                                </a>
                                            </span>
                                            <span class="description">Mensaje Enviado - {{$message->created_at}}</span>
                                        </div>
                                        <!-- /.user-block -->
                                        <p>
                                            {{$message->message}}
                                        </p>
                                    </div>
                                @endforeach
                            
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-12 col-lg-4 order-1 order-md-2">
                        <h3 class="text-primary" id="ticketId"><i class="fas fa-ticket-alt"></i> Ticket N°: {{$ticket->id}}</h3>
                        @if ( $ticket_user->contains('user_id', auth()->user()->id))
                            <div class="form-group">
                                <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                                <label class="text-muted">Estado: </label>
                                <select class="form-control" name="state" id="stataSelect"  style="width: 150px;">
                                    @foreach ($states as $state)
                                        <option value="{{$state->id}}" @if ($state->id === $ticket->state_id)
                                            selected
                                        @endif >{{$state->name}}</option>
                                    @endforeach
                                </select>
                                <button class="btn btn-primary my-2" id="btnState">Cambiar</button>
                            </div>
                        @endif
                        <p class="text-muted">Problema:
                            <b class="d-block">{{$ticket->description}}</b>
                        </p>
                        <div class="text-muted">
                            <p class="text-sm">Institucion
                                <b class="d-block">{{$ticket->institution->name}}</b>
                            </p>
                            <p class="text-sm">Encargado
                                <b class="d-block">{{$responsible}}</b>
                            </p>
                        </div>
                        <div class="text-muted">Integrantes del Equipo:
                            @foreach ($ticket->user->slice(1) as $tickett)
                                <b class="d-block">- {{$tickett->name}}</b>
                            @endforeach
                        </div>
                        
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->
</div>

@endsection

@section('scripts')
    @notify_js
    @notify_render
    <!-- Select2 -->
    <script src=" {{ asset('AdminLTE/plugins/select2/js/select2.full.min.js') }}"></script>
    <script>
        $( document ).ready(function() {
            
            $('.select2bs4').hide();
            
            $('.btnaAddTeam').hide();
          
            // manera de pasar variables php a javascrip var ticket = @json($ticket);

        });


        $("#addTeam").click(function() {
            $(this).hide();
            $('.select2bs4').show();
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            });
            $('.btnaAddTeam').show();
           
        });

        $('#btnState').click(function(){
            let state = $(this).parent().find('select').val();
            let ticketId = $("#ticketId").val();
            $.post( "/change_state", {  _token: $('#token').val(), id: ticketId, state: state })
            .done(function( data ) {
                console.log(data);
                toastr.success(data.message);
                $("#badge").removeClass();
                if (data.state === "1") {               
                    $("#badge").addClass("badge badge-danger");
                    $("#badge").text("Sin Resolver");
                }else if(data.state === "2"){
                    $("#badge").addClass("badge badge-warning");
                    $("#badge").text("En Progreso");
                }else if(data.state === "3"){
                    $("#badge").addClass("badge badge-success");
                    $("#badge").text("Resuelto");
                }
                   
            })
            .fail(function(data){
                toastr.error(data.message)
                console.log(data)

            });
   
        });
        
        



    </script>
@endsection