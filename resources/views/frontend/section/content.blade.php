@extends('frontend.master')
@section('stylus')
  @notify_css
  <!-- Datatables Bootstrap -->
  <link rel="stylesheet" href={{ asset('AdminLTE/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}>
  <link rel="stylesheet" href={{ asset('AdminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}>
  {{-- gijgo datapicker --}}
  <link rel="stylesheet" href={{ asset('AdminLTE/plugins/gijgo/css/gijgo.min.css') }}>
@endsection

@section('content_frontend')

 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">

     <!-- Errores Backend -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          @if (auth()->user()->role->name == 'admin')  
            <div class="ml-2 my-2">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default">
                    Crear Nuevo Ticket
                </button>
            </div> 
          @endif
        </div>
        <!-- /.row -->    
        <div class="row my-2">
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                    <h3>{{$ticketsTotal}}</h3>
        
                        <p>Tickets Totales</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-clipboard-list" aria-hidden="true"></i>
                    </div>
                    <a href="#" class="small-box-footer" id="ticketsTotals">Mas Info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                    <div class="inner">
                    <h3>{{$ticketsResolved}}</h3>
        
                        <p>Tickets Resueltos</p>
                    </div>
                    <div class="icon">
                        <i class="far fa-laugh"></i>
                    </div>
                    <a href="#" class="small-box-footer" id="ticketsResolved">Mas Info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                    <div class="inner">
                    <h3>{{$ticketsInProgress}}</h3>
        
                        <p>Tickets en Progreso</p>
                    </div>
                    <div class="icon">
                        <i class="far fa-grimace"></i>
                    </div>
                    <a href="#" class="small-box-footer ticketsInProgress">Mas Info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>{{$unresolvedTickets}}</h3>
        
                        <p>Tickets sin Resolver</p>
                    </div>
                    <div class="icon">
                        <i class="far fa-grin-beam-sweat"></i>
                    </div>
                    <a href="#" class="small-box-footer ticketsUnresolved">Mas Info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
        </div>
        <!-- /.row -->
        <!-- /.row  Table -->
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Tickets</h3>

              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered table-striped" id="example">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Descrpcion</th>
                      <th>created_at'</th>
                      <th>Responsable</th>
                      <th>Prioridad</th>
                      <th>Institucion'</th>
                      <th>Estado</th>
                      <th>Acciones</th>
                      
                    </tr>
                  </thead>
                  
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>
  <!-- /.control-sidebar -->
  {{-- Modales --}}
  @include('frontend.section.modals.modalEdit')
  @include('frontend.section.modals.modalDelete')
  @include('frontend.section.modals.modalCreate')
   {{-- Modales --}}

  @endsection

  @section('scripts')
    @notify_js
    @notify_render
    <!-- Datatables Bootstrap -->
    <script src="{{ asset('AdminLTE/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('AdminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('AdminLTE/plugins//datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('AdminLTE/plugins//datatables-buttons/js/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('AdminLTE/plugins//datatables-buttons/js/jszip.min.js') }}"></script>
    <script src="{{ asset('AdminLTE/plugins//datatables-buttons/js/pdfmake.min.js') }}"></script>
    <script src="{{ asset('AdminLTE/plugins//datatables-buttons/js/vfs_fonts.js') }}"></script>
    <script src="{{ asset('AdminLTE/plugins//datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('AdminLTE/plugins//datatables-buttons/js/buttons.print.min.js') }}"></script>

    {{-- gijgo datapicker --}}
    <script src={{ asset('AdminLTE/plugins/gijgo/js/gijgo.min.js') }}> </script>
    <!-- jquery-validation -->
    <script src="{{ asset('AdminLTE/plugins/jquery-validation/jquery.validate.min.js')}}"> </script>
    <script src="{{ asset('AdminLTE/plugins/jquery-validation/localization/messages_es_AR.min.js')}}"> </script>
    <script src="{{ asset('AdminLTE/plugins/jquery-validation/additional-methods.min.js')}}"></script>
    <script>
      var role = {!! json_encode(auth()->user()->role->name, JSON_HEX_TAG) !!};
      var buttonsAdmin = '';
      console.log(role);
      if (role === 'admin') {
        buttonsAdmin =
          "<button class='btn edit' type='button'><i class='far fa-edit'></i></button><button class='btn ml-1 delete' type='button'><i class='far fa-trash-alt'></i></button>"
        }
      var buttons = 
                "<div class='btn-group' role='group'>"+
                "<a class='btn view' href='#'><i class='fas fa-eye'></i></a>"
                  +buttonsAdmin+
                "</div>";
      $( document ).ready(function() {
            
        $('#startDate').datepicker({
            uiLibrary: 'bootstrap'
        });
        $('#endDate').datepicker({
            uiLibrary: 'bootstrap'
        });
        cargarDatos('http://sigef.test/getTickets/0');
        $.validator.setDefaults({
          submitHandler: function () {
            alert( "Form successful submitted!" );
          }
        });

        

      });
      $('.ticketsUnresolved').click(function(){
        cargarDatos('http://sigef.test/getTickets/1');
      });
      $('.ticketsInProgress').click(function(){
        cargarDatos('http://sigef.test/getTickets/2');
      });
      $('#ticketsResolved').click(function(){
        cargarDatos('http://sigef.test/getTickets/3');
      });
      $('#ticketsTotals').click(function(){
        cargarDatos('http://sigef.test/getTickets/0');
      });


      $(document).on('click','.edit',function(event) {
        let ticketId = '';
        
        let ticketData = {
            'ticketID' : '',
            'ticketCreated' : '',
            'institution' : '',
            'user' :  '',
            'priority' : '',
            'state' : '',
            'descripcion' : '',
            'startDate' : '',
            'endDate' : ''

          };
          
          ticketData.ticketID = $(this).parents("tr").find("td").eq(0).html();
         
          $.get( "/ticket/"+ticketData.ticketID+"", function( data ) {
            ticketData.ticketCreated = data.ticket.ticketCreated;
            ticketData.institution   = data.ticket.description;
            ticketData.user          = data.ticket.user;
            ticketData.priority      = data.ticket.priority;
            ticketData.state         = data.ticket.state;
            ticketData.descripcion   = data.ticket.description;
            ticketData.startDate     = data.ticket.start_date;
            ticketData.endDate       = data.ticket.end_date;

            console.log(formatDate(ticketData.startDate));
            $('#start_date').datepicker({
            uiLibrary: 'bootstrap'
            });
            $('#end_date').datepicker({
                uiLibrary: 'bootstrap'
            });
            $('#modalEdit').modal('show');
            $("textarea#descriptionText").val(ticketData.descripcion);
            $("#institutionSelect").find('option:contains("'+ticketData.institution+'")').prop('selected', true);
            $("#"+ticketData.priority+"").prop("checked", true); 
            $("#selectUser").find('option:contains("'+ticketData.user+'")').prop('selected', true);
            $("#start_date").val(formatDate(ticketData.startDate));
            $("#end_date").val(formatDate(ticketData.endDate));
            let formAction = "/ticket/" + ticketData.ticketID;
            $('#formEdit').attr('action', formAction);
           });
      });
      
      


      $(document).on('click','.delete',function(event) {
        $('#modalDelete').modal('show');
          let ticketID = $(this).parents("tr").find("td").eq(0).html();        
          let formAction = "/ticket/" + ticketID;
          $('#formDelete').attr('action', formAction);
        });
        $(document).on('click','.view',function(event) {
          let ticketID = $(this).parents("tr").find("td").eq(0).html();
          let url = "/tickets/"+ ticketID;
          $(".view").attr("href", url);
        });


        function cargarDatos(url){
          $('#example').DataTable().clear().destroy();
          //s$('#example').empty();
          $('#example').DataTable( {
              "serverSide": true,
              "dom": 'Bfrtip',
              "buttons": [
                  'copy', 'csv', 'excel', 'pdf', 'print'
              ],
              "ajax": url,
              "columns": [
                { data: 'id' },
                { data: 'description' },
                { data: 'ticketCreated.date' },
                { data: 'user' },
                { data: 'priority' },
                { data: 'institution' },
                {data : 'state'},
                {"defaultContent": buttons}
              ],
              "language": {
                  "info": "_TOTAL_ registros",
                  "search": "Buscar",
                  "paginate": {
                      "next": "Siguiente",
                      "previous": "Anterior",
                  },
                  "lengthMenu": 'Mostrar <select >'+
                              '<option value="10">10</option>'+
                              '<option value="25">25</option>'+
                              '<option value="50">50</option>'+
                              '<option value="75">75</option>'+
                              '<option value="-1">Todos</option>'+
                              '</select> registros',
                  "loadingRecords": "Cargando...",
                  "processing": "Procesando...",
                  "emptyTable": "No hay datos",
                  "zeroRecords": "No hay coincidencias", 
                  "infoEmpty": "",
                  "infoFiltered": ""
              }
              
          });
             
        }

        function formatDate(fecha){
          let date = new Date(fecha);   
          let month = date.getMonth()+1;
          let dt = date.getDate()+1;
          let year = date.getFullYear();

          if (dt < 10) {
            dt = '0' + dt;
          }
          if (month < 10) {
            month = '0' + month;
          }


          return(month+'/' + dt + '/'+year);
        }
        
        // Validaciones
        $('#formTicket').validate({
          rules: {
            userId: {
              required: true
            },
            institution: {
              required: true
            },
            start_date: {
              required: true,
              date: true
            },
            end_date: {
              required: true,
              date: true
            },
            priority: {
              required: true
            },
            description: {
              required: true
            },
          },
          
          errorElement: 'span',
          errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
          },
          highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
          },
          unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
          }
        });

         // Validaciones
         $('#formEdit').validate({
          rules: {
            userId: {
              required: true
            },
            institution: {
              required: true
            },
            start_date: {
              required: true,
              date: true
            },
            end_date: {
              required: true,
              date: true
            },
            priority: {
              required: true
            },
            description: {
              required: true
            },
          },
          
          errorElement: 'span',
          errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
          },
          highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
          },
          unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
          }
        });

        

    </script>

  @endsection