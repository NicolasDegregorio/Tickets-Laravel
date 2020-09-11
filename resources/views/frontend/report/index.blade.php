@extends('frontend.master')
@section('stylus')
<link rel="stylesheet" href={{ asset('AdminLTE/plugins/daterangepicker/daterangepicker.css') }}>

@endsection


@section('content_frontend')

<!-- Main content -->
<section class="content-wrapper">
    <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title">Reportes de Tickets</h5>
                <br>
                <a href="{{ url('/reports') }}" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Imprimir</a>
                <div class="card-tools">
                  <div id="reportrange" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
                    <i class="fa fa-calendar"></i>&nbsp;
                    <span></span> <i class="fa fa-caret-down"></i>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                  <div class="col-md-8">
                    <p class="text-center" id="dateRange">

                    </p>
                    
                    <div class="chart">
                      <canvas id="barChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                    </div>
                    {{-- <div class="chart">
                      <!-- Sales Chart Canvas -->
                      <canvas id="salesChart" height="180" style="height: 180px;"></canvas>
                    </div> --}}
                    <!-- /.chart-responsive -->
                  </div>
                  <!-- /.col -->
                  <div class="col-md-4">
                    <p class="text-center">
                      <strong>Situacion de los Tickets</strong>
                    </p>
                    <!-- /.progress-group -->
                    <div class="progress-group">
                      Tickets Sin Resolver
                      <span class="float-right" id="unresolved"></span>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-danger" id="progressUnresolved"></div>
                      </div>
                    </div>
                    <div class="progress-group">
                      Tickets en Progreso
                      <span class="float-right" id="inProcess"></span>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-warning" id="progressInProcess"></div>
                      </div>
                    </div>
                    <div class="progress-group">
                      <span class="progress-text">Tickets Resueltos</span>
                      <span class="float-right" id="resolved"></span>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-success" id="progressRevolved"></div>
                      </div>
                    </div>
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </div>
              <!-- ./card-body -->
              <div class="card-footer">
                <div class="row">
                  <div class="col-sm-3 col-6">
                    <div class="description-block border-right">
                      <span class="description-percentage text-success" id="porcetageTr"></i> </span>
                      <h5 class="description-header" id="tickersR"></h5>
                      <span class="description-text">Tickets Resueltos</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-3 col-6">
                    <div class="description-block border-right">
                      <span class="description-percentage text-warning" id="porcetageTip"></i></span>
                      <h5 class="description-header" id="ticketsInP"></h5>
                      <span class="description-text">Tickets en Progreso</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-3 col-6">
                    <div class="description-block border-right">
                      <span class="description-percentage text-danger" id="porcetageTun"></span>
                      <h5 class="description-header" id="ticketsU"></h5>
                      <span class="description-text">Tickets Sin Resolver</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-3 col-6">
                    <div class="description-block">
                      <span class="description-percentage text-primary"></i> </span>
                      <h5 class="description-header" id="TicketsT"></h5>
                      <span class="description-text">Tickets Totales</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                </div>
                <!-- /.row -->
              </div>
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
</section>


@endsection

@section('scripts')
<!-- DateRanger -->
<script src="{{ asset('AdminLTE/plugins/daterangepicker/moment.min.js')}}"> </script>
<script src="{{ asset('AdminLTE/plugins/daterangepicker/daterangepicker.min.js')}}"> </script>
<!-- Chart -->
<script src="{{ asset('AdminLTE/plugins/chart.js/Chart.min.js')}}"> </script>

<script>
  $( document ).ready(function() {
    var start = moment().subtract(29, 'days');
    var end = moment();

    function cb(start, end) {
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
    }

    $('#reportrange').daterangepicker({
        startDate: start,
        endDate: end,
        "locale": {
          "separator": " - ",
          "applyLabel": "Aplicar",
          "cancelLabel": "Cancelar",
          "fromLabel": "DE",
          "toLabel": "HASTA",
          "customRangeLabel": "Custom",
          "daysOfWeek": [
              "Dom",
              "Lun",
              "Mar",
              "Mie",
              "Jue",
              "Vie",
              "Sáb"
          ],
          "monthNames": [
              "Enero",
              "Febrero",
              "Marzo",
              "Abril",
              "Mayo",
              "Junio",
              "Julio",
              "Agosto",
              "Septiembre",
              "Octubre",
              "Noviembre",
              "Diciembre"
          ],
          "firstDay": 1
        },
        ranges: {
          'Hoy': [moment(), moment()],
          'Ayer': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Ultimos 7 Dias': [moment().subtract(6, 'days'), moment()],
          'Ultimos 30 Dias': [moment().subtract(29, 'days'), moment()],
          'Este Mes': [moment().startOf('month'), moment().endOf('month')],
          'Anterior Mes': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        }
    }, cb);

    cb(start, end);

    $.get("/filter/range_date", {start: currentDate(), end: currentDate()})
        .done(function( respuesta ) {
          barCharts(respuesta);
          $('#dateRange').html("<strong> Tickets del "+currentDate()+ "</strong");
        })
        .fail(function() {
          alert( "error" );
        });
        $.get("/filter/ticket_situation", {start: currentDate(), end: currentDate()})
        .done(function( respuesta ) {
          ticketSituation(respuesta);
        })
        .fail(function() {
          alert( "error" );
        });

    $('#reportrange').on('apply.daterangepicker', function(ev, picker) {
      localStorage.clear();
      let startDate = picker.startDate.format('YYYY-MM-DD');
      let endDate = picker.endDate.format('YYYY-MM-DD');
      localStorage.setItem('startDate', startDate);
      localStorage.setItem('endDate', endDate);

      $('#dateRange').html("<strong> Tickets del "+startDate+" Al "+endDate+"</strong")
      $.get("/filter/ticket_situation", {start: startDate, end: endDate})
        .done(function( respuesta ) {
          ticketSituation(respuesta);
        })
        .fail(function() {
          alert( "error" );
        });
      
      $.get("/filter/range_date", {start: startDate, end: endDate})
      .done(function( respuesta ) {
        updateBarChart(respuesta);
      })
      .fail(function() {
        alert( "error" );
      });
        

    });

  });

  
  

  function barCharts(respuesta){
    

    var meses = [];
    var ticketsResolved = [];
    var ticketsInProgress = [];
    var unresolvedTickets = [];


    result = respuesta.reduce(function (r, a) {
          r[a.month] = r[a.month] || [];
          r[a.month].push(a);
          return r;
      }, Object.create(null));

    $.each( result, function( key, value ) {
      monthLetters(key,meses)
    });

    $.each(result, function() {
      $.each(this, function(name, value) {
        if (value.state === 1) {
          unresolvedTickets.push(value.value)
        } else if(value.state === 2){
          ticketsInProgress.push(value.value)
        } else if(value.state === 3){
          ticketsResolved.push(value.value)
        }
      });
    });
    localStorage.setItem('ticketsResolved', JSON.stringify(ticketsResolved));
    localStorage.setItem('ticketsInProgress', JSON.stringify(ticketsInProgress));
    localStorage.setItem('unresolvedTickets', JSON.stringify(unresolvedTickets));

    //-------------
    //- BAR CHART -
    //-------------
    var barChartCanvas = $('#barChart').get(0).getContext('2d')
      var barChartData = {
        labels  : meses,
        datasets: [
          {
            label               : 'Tickets sin Resolver',
            backgroundColor     : 'rgba(255, 0, 0, 1)',
            borderColor         : 'rgba(255, 0, 0, 1)',
            pointRadius         : false,
            pointColor          : 'rgba(255, 0, 0, 1)',
            pointStrokeColor    : '#c1c7d1',
            pointHighlightFill  : '#fff',
            pointHighlightStroke: 'rgba(220,220,220,1)',
            data                : unresolvedTickets
          },
          
          {
            label               : 'Tickets en Progreso',
            backgroundColor     : 'rgba(255, 255, 0, 1)',
            borderColor         : 'rgba(255, 255, 0, 1)',
            pointRadius         : false,
            pointColor          : 'rgba(255, 255, 0, 1)',
            pointStrokeColor    : '#c1c7d1',
            pointHighlightFill  : '#fff',
            pointHighlightStroke: 'rgba(220,220,220,1)',
            data                : ticketsInProgress
          },
          {
            label               : 'Tickets Resueltos',
            backgroundColor     : 'rgba(0, 255, 0, 1)',
            borderColor         : 'rgba(0, 255, 0, 1)',
            pointRadius          : false,
            pointColor          : '#3b8bba',
            pointStrokeColor    : 'rgba(0, 255, 0, 1)',
            pointHighlightFill  : '#fff',
            pointHighlightStroke: 'rgba(60,141,188,1)',
            data                : ticketsResolved
          },
        ]
      }
          

      var barChartOptions = {
        responsive              : true,
        maintainAspectRatio     : false,
        datasetFill             : false
      }
      


      barChart = new Chart(barChartCanvas, {
        type: 'bar', 
        data: barChartData,
        options: barChartOptions,
      })

      

      
  }      


  function ticketSituation(respuesta){
    
    let ticketsTotal = respuesta.ticketsAll;
    $("#TicketsT").text(respuesta.ticketsAll);
    localStorage.setItem('ticketsTotal', ticketsTotal);
    $("#resolved").html("<b>"+respuesta.ticketsResolved+"</b>/"+ticketsTotal);
    let percentageResolved = percentage(respuesta.ticketsResolved,ticketsTotal) ;
    $("#porcetageTr").text(percentageResolved+"%");
    $("#tickersR").text(respuesta.ticketsResolved);
    if (percentageResolved > 0) {
      $("#progressRevolved").css("width", percentageResolved+"%");
    }else{
      $("#progressRevolved").css("width", "0%");;
    }
    
    

    $("#inProcess").html("<b>"+respuesta.ticketsInProgress+"</b>/"+ticketsTotal);
    let percentageInProcess = percentage(respuesta.ticketsInProgress,ticketsTotal) ;
    $("#porcetageTip").text(percentageInProcess+"%");
    $("#ticketsInP").text(respuesta.ticketsInProgress);
    if (percentageInProcess > 0) {
      $("#progressInProcess").css("width", percentageInProcess+"%");
    }else{
      $("#progressInProcess").css("width", "0%");;
    }

    $("#unresolved").html("<b>"+respuesta.unresolvedTickets+"</b>/"+ticketsTotal);
    let percentageUnresolved = percentage(respuesta.unresolvedTickets,ticketsTotal) ;
    $("#porcetageTun").text(percentageUnresolved+"%");
    $("#ticketsU").text(respuesta.unresolvedTickets);
    if (percentageUnresolved > 0) {
      $("#progressUnresolved").css("width", percentageUnresolved+"%");
    }else{
      $("#progressUnresolved").css("width", "0%");;
    }
   
  }

  function updateBarChart(respuesta){
    barCharts(respuesta);
    localStorage.setItem('ticketsResolved', JSON.stringify(ticketsResolved));
    localStorage.setItem('ticketsInProgress', JSON.stringify(ticketsInProgress));
    localStorage.setItem('unresolvedTickets', JSON.stringify(unresolvedTickets));
    barChart.data.datasets[0].data = unresolvedTickets;
    barChart.data.datasets[1].data = ticketsInProgress;
    barChart.data.datasets[2].data = ticketsResolved;
    barChart.data.labels = meses;
    barChart.update();  
  }

  function percentage (numMenor,numMayor){
    return (numMenor/numMayor) * 100;
  }

  function currentDate (){
    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth() + 1; 
    var yyyy = today.getFullYear();

    if (dd < 10) {
      dd = '0' + dd;
    }

    if (mm < 10) {
      mm = '0' + mm;
    }

    return mm + '/' + dd + '/' + yyyy;
  }

  function monthLetters(month, arrayMonth){
    switch (month) {
      case "1":
        arrayMonth.push("Enero");
        break;

      case "2":
        arrayMonth.push("Febrero");
        break;

      case "3":
        arrayMonth.push("Marzo");
        break;
        
      case "4":
        arrayMonth.push("Abril");
        break;

      case "5":
        arrayMonth.push("Mayo");
        break;

      case "6":
        arrayMonth.push("Junio");
        break;
        
      case "7":
        arrayMonth.push("Julio");
        break;

      case "8":
        arrayMonth.push("Agosto");
        break;

      case "9":
        arrayMonth.push("Septiembre");
        break;

      case "10":
        arrayMonth.push("Octubre");
        break;
        
      case "11":
        arrayMonth.push("Noviembre");
        break;
      
      case "12":
        arrayMonth.push("Diciembre");
        break;
      
      default:
        console.log("Ocurrio un Error");
        break;
    }

  }



  


</script>

@endsection