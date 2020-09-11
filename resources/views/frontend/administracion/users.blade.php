@extends('frontend.master')
@section('stylus')
  @notify_css 
  <!-- Datatables Bootstrap -->
  <link rel="stylesheet" href={{ asset('AdminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}>

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
            <div class="ml-2 my-2">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default">
                    Crear Nuevo Usuario
                </button>
            </div> 
        </div>   

        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Usuarios</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered table-striped" id="example">
                  <thead>
                    <tr>
                      <th>id</th>
                      <th>name</th>
                      <th>email'</th>
                      <th>rol</th>
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
  {{-- Modals --}}
  @include('frontend.administracion.modals.users.edit')
  @include('frontend.administracion.modals.users.create')
  @include('frontend.administracion.modals.users.delete')
  @endsection

  @section('scripts')
    @notify_js
    @notify_render
    <!-- Datatables Bootstrap -->
    <script src="{{ asset('AdminLTE/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('AdminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <!-- jquery-validation -->
    <script src="{{ asset('AdminLTE/plugins/jquery-validation/jquery.validate.min.js')}}"> </script>
    <script src="{{ asset('AdminLTE/plugins/jquery-validation/additional-methods.min.js')}}"></script>
    <script>
      $( document ).ready(function() {
        $('#example').DataTable( {
              "serverSide": true,
              "responsive": true,
              "ordering": true,
              "autoWidth": false,
              "ajax": '{{url('/users')}}',
              "columns": [
                { data: 'id' },
                { data: 'name' },
                { data: 'email' },
                { data: 'rol' },
                {"defaultContent": "<button class='btn edit' type='button'><i class='far fa-edit'></i></button><button class='btn  delete' type='button'><i class='far fa-trash-alt'></i></button>"}
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
        $.validator.setDefaults({
          submitHandler: function () {
            alert( "Form successful submitted!" );
          }
        });

      });

      $(document).on('click','.edit',function(event) {
        
        let userData = {
            'userID' : '',
            'email' : '',
            'role' : ''
            
          };
          
          userData.userID = $(this).parents("tr").find("td").eq(0).html();
         
          $.get( "/users/"+userData.userID+"", function( data ) {
            userData.name          = data.user.name;
            userData.email           = data.user.email;
            userData.role            = data.user.rol;
            
            console.log(userData);
            $('#modalEdit').modal('show');
            $('#userName').val(userData.name  );
            $('#userEmail').val(userData.email);
            $("#roleSelect").find('option:contains("'+userData.role +'")').prop('selected', true);
             
            let formAction = "/users/" + userData.userID;
            $('#formEdit').attr('action', formAction);
           });
        });

        $(document).on('click','.delete',function(event) {
        $('#modalDelete').modal('show');
          let ticketID = $(this).parents("tr").find("td").eq(0).html();        
          let formAction = "/users/" + ticketID;
          $('#formDelete').attr('action', formAction);
        });

        // Validaciones
      $('#formUser').validate({
          rules: {
            name: {
              required: true
            },
            email: {
              email: true,
              required: true
            },
            password: { 
              required: true,
              minlength: 6,
            }, 
            password_confirmation: { 
              equalTo: "#password",
              minlength: 6,
           },
           role:{
            required: true,
           },
            
          },
          messages: {
            name: {
              required: "Por Favor Escriba un Nombre",
            },
            email: {
              required: "Por favor Escriba un email",
              email: "Formato de email invalido"
            },
            password: {
              required: "Campo Requerido",
              minlength: "Minimo Seis Caracteres",
            },
            password_confirmation: {
              equalTo: "Las contraseñas no Coinciden",
            },
            role:{
              required: "Por favor Seleccione un rol"
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

        $('#formEdit').validate({
          rules: {
            name: {
              required: true
            },
            email: {
              email: true,
              required: true
            },
            password: { 
              required: true,
              minlength: 6,
            }, 
           role:{
            required: true,
           },
            
          },
          messages: {
            name: {
              required: "Por Favor Escriba un Nombre",
            },
            email: {
              required: "Por favor Escriba un email",
              email: "Formato de email invalido"
            },
            password: {
              required: "Campo Requerido",
              minlength: "Minimo Seis Caracteres",
            },
            role:{
              required: "Por favor Seleccione un rol"
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