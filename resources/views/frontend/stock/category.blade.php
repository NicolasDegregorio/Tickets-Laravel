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
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalCreate">
                    Dar de Alta una Categoria
                </button>
            </div> 
        </div>   
        
        <!-- /.row  Table -->
        <div class="row my-2">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Categoria</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered table-striped" id="example">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Nombre</th>
                      <th>Descripcion</th>
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
        <!-- /.row table-->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->




  
  {{-- Modals --}}
  @include('frontend.stock.modals.category.create')
  @include('frontend.stock.modals.category.edit')
  @include('frontend.stock.modals.category.delete')
 
  @endsection

  @section('scripts')
    @notify_js
    @notify_render
    <!-- Datatable -->
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
              "ajax": '{{url('/categories')}}',
              "columns": [
                { data: 'id' },
                { data: 'name' },
                { data: 'description'},
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
          
          let categoryData = {
            'id' : '',
            'name' : '',
            'description' : ''
          };
          categoryData.id = $(this).parents("tr").find("td").eq(0).html();
         
         $.get( "/category/"+categoryData.id+"", function( data ) {
            categoryData.name        = data.category.name;
            categoryData.description = data.category.description;
           
           console.log(categoryData);
           $('#modalEdit').modal('show');
           $('#name').val(categoryData.name);
           $('#description').val(categoryData.description);
           
           let formAction = "/category/" + categoryData.id;
            $('#formEdit').attr('action', formAction);
          });
       });

       $(document).on('click','.delete',function(event) {
        $('#modalDelete').modal('show');
        let categoryId = $(this).parents("tr").find("td").eq(0).html();
          let formAction = "/category/" + categoryId;
          $('#formDelete').attr('action', formAction);
      });

      // Validaciones
      $('#formCategory').validate({
          rules: {
            name: {
              required: true
            },
            description: {
              required: true
            },
            
          },
          messages: {
            name: {
              required: "Por Favor Escriba un Nombre",
            },
            description: {
              required: "Por Favor Describa la Categoria",
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
            name: {
              required: true
            },
            description: {
              required: true
            },
            
          },
          messages: {
            name: {
              required: "Por Favor Escriba un Nombre",
            },
            description: {
              required: "Por Favor Describa la Categoria",
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