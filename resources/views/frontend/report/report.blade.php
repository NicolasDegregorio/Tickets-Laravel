<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>SIGEF - Reporte Tickets</title>
    
    <style>


    .invoice-box {
        max-width: 800px;
        margin: auto;
        padding: 30px;
        border: 1px solid #eee;
        box-shadow: 0 0 10px rgba(0, 0, 0, .15);
        font-size: 16px;
        line-height: 24px;
        font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        color: #555;
    }
    
    .invoice-box table {
        width: 100%;
        line-height: inherit;
        text-align: left;
    }
    
    .invoice-box table td {
        padding: 5px;
        vertical-align: top;
    }
    
    .invoice-box table tr td:nth-child(2) {
        text-align: right;
    }
    
    .invoice-box table tr.top table td {
        padding-bottom: 20px;
    }
    
    .invoice-box table tr.top table td.title {
        font-size: 45px;
        line-height: 45px;
        color: #333;
    }
    
    .invoice-box table tr.information table td {
        padding-bottom: 40px;
    }
    
    .invoice-box table tr.heading td {
        background: #eee;
        border-bottom: 1px solid #ddd;
        font-weight: bold;
    }
    
    .invoice-box table tr.details td {
        padding-bottom: 20px;
    }
    
    .invoice-box table tr.item td{
        border-bottom: 1px solid #eee;
    }
    
    .invoice-box table tr.item.last td {
        border-bottom: none;
    }
    
    .invoice-box table tr.total td:nth-child(2) {
        border-top: 2px solid #eee;
        font-weight: bold;
    }
    
    @media only screen and (max-width: 600px) {
        .invoice-box table tr.top table td {
            width: 100%;
            display: block;
            text-align: center;
        }
        
        .invoice-box table tr.information table td {
            width: 100%;
            display: block;
            text-align: center;
        }
    }
    
    /** RTL **/
    .rtl {
        direction: rtl;
        font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
    }
    
    .rtl table {
        text-align: right;
    }
    
    .rtl table tr td:nth-child(2) {
        text-align: left;
    }
    </style>
</head>

<body>
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="2">
                    <table  id="date">
                        <tr>
                            <td class="title">
                                <img src="{{ asset('AdminLTE/dist/img/logo.jpeg') }}" style="width:70%; max-width:120px;">
                            </td>
                            
                        </tr>
                    </table>
                </td>
            </tr>
            
            <tr class="information">
                <td colspan="2">
                    <table>
                        <tr>
                            <td>
                                SIGEF<br>
                                Min. de Cultura y Educacion<br>
                                Juan Jose Silva 57
                            </td>
                            
                            <td>
                                Acme Corp.<br>
                                John Doe<br>
                                john@example.com
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            
            <tr class="heading">
                <td>
                    Tickets Totales
                </td>
                
                <td>
                   N°
                </td>
            </tr>
            
            <tr class="details">
                <td>
                    Cantidad
                </td>
                
                <td id="ticketsAll">
                    
                </td>
            </tr>
            
            <tr class="heading">
                <td>
                    Estado
                </td>
                
                <td>
                    N°
                </td>
            </tr>
            
            <tr class="item">
                <td>
                    Tiquets Resueltos
                </td>
                
                <td id="ticketsResolved">
                    
                </td>
            </tr>
            
            <tr class="item">
                <td>
                    Tiquets en Progreso
                </td>
                
                <td id="ticketsinProgress">
                    
                </td>
            </tr>
            
            <tr class="item last">
                <td>
                    Tiquets sin Resolver
                </td>
                
                <td id="ticketsUnresolved">
                    
                </td>
            </tr>
            
            <tr class="total">
                <td>Total:</td>
                
                <td id="total">
                   
                </td>
            </tr>
        </table>
    </div>


<script src="{{ asset('AdminLTE/plugins/jquery/jquery.js') }}"></script>
<script>
    $( document ).ready(function() {
        $('#ticketsUnresolved').text(sumTickets(localStorage.getItem("unresolvedTickets")));
        $('#ticketsinProgress').text(sumTickets(localStorage.getItem("ticketsInProgress")));
        $('#ticketsResolved').text(sumTickets(localStorage.getItem("ticketsResolved")));
        $('#ticketsAll').text(localStorage.getItem("ticketsTotal"));
        $('#total').text(localStorage.getItem("ticketsTotal"));

        var htmlTags = 
                    '<td>'+
                        'Reporte de Tickets<br>'+
                        'Fecha: '+localStorage.getItem("startDate")+ ' a '+localStorage.getItem("endDate")+'<br>'+
                    '</td>';
        $('#date tr').append(htmlTags);  
    
    });

    function sumTickets(tickets){
        ticketsParse =  JSON.parse(tickets);
        let total = ticketsParse.reduce((a, b) => a + b, 0);
        return total;

    }
    window.addEventListener("load", window.print());

</script>

</body>
</html>
