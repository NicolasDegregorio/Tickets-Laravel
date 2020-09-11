<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>Sigef Interno</title>

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href={{ asset('AdminLTE/plugins/fontawesome-free/css/all.min.css') }}>
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('AdminLTE/dist/css/adminlte.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  
  @yield('stylus')
</head>


<body class="hold-transition sidebar-mini">
<div class="wrapper">
  @include('frontend.section.navbar')
  @include('frontend.section.sidebar')
  @yield('content_frontend')
  @include('frontend.section.footer')
  
 


  
 </div>


<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="{{ asset('AdminLTE/plugins/jquery/jquery.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('AdminLTE/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('AdminLTE/dist/js/adminlte.min.js') }}"></script>

<script>
  $.get("/dashboard/usuarios/tickets")
        .done(function( respuesta ) {
          $('#ticketsTotal').text("Tickets Totales: "+respuesta.ticket.total);
          $('#ticketsUnresolved').text(respuesta.ticket.unresolved);
          $('#ticketsInProgress').text(respuesta.ticket.inProgress);
        })
        .fail(function() {
          alert( "error" );
        });
  var url = window.location;
  const allLinks = document.querySelectorAll('.nav-item a');
  const currentLink = [...allLinks].filter(e => {
      return e.href == url;
  });

  currentLink[0].classList.add("active");
  currentLink[0].closest(".nav-treeview").style.display = "block";
  currentLink[0].closest(".has-treeview").classList.add("menu-open");
  $('.menu-open').find('a').each(function() {
      if (!$(this).parents().hasClass('active')) {
          $(this).parents().addClass("active");
          $(this).addClass("active");
      }
  });
  
</script>
@yield('scripts')
</body>
</html>
