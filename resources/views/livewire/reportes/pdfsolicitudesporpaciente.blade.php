<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <title>Reporte - {{ $nombre }}</title>
<style>
        body{
        position: relative;
        color: #222;
        font-family: "Helvetica", Arial, Verdana, sans-serif;
        font-size: 15px;
        line-height: 1.4;
        margin-left: 0;
        margin-right: 0;
        padding-left: 0;
        padding-right: 0;
      }
    @page {
      margin: 160px 60px;
    }
    header { position: fixed;
      left: 0px;
      top: -160px;
      right: 0px;
      height: 100px;
      text-align: center;
    }
    header h1{
      margin: 10px 0;
    }
    header h2{
      margin: 0 0 10px 0;
    }
    footer {
      position: fixed;
      left: 0px;
      bottom: -100px;
      right: 0px;
      height: 40px;
      border-bottom: 2px solid #ddd;
    }
    footer .page:after {
      content: counter(page);
    }
    footer table {
      width: 100%;
    }
    footer p {
      text-align: right;
    }
    footer .izq {
      text-align: left;
    }
    .invoice-title {
         margin-top: -50px;
    }
    .invoice-title h2, .invoice-title h3 {
        display: inline-block;
    }
    
    .table > tbody > tr > .no-line {
        border-top: none;
    }
    .table > thead > tr > .no-line {
        border-bottom: none;
    }
    
    .table > tbody > tr > .thick-line {
        border-top: 2px solid;
    }
    .table-responsive{
      margin-top: -50px;
      font-size: 10px;
      width: 100%;
    }
    
</style>
<body>
    <header style="display: inline;">
      <img  width="70" src="../public/assets/img/logo-lab.png">
      <p class="mb-0 text-info"><strong>LABORATORIO CLÍNICO "SAN GABRIEL"</strong></p>
      
    </header>
    <footer>
        <table>
          <tr>
            <td>
                <p class="izq">
                  Dirección: Av. Murillo #179  Teléfono: 612015 Celular: 210212
                </p>
            </td>
            <td>
              <p class="page">
                Página
              </p>
            </td>
          </tr>
        </table>
    </footer>
    <div class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="row">
                  <div class="col-xs-12">
                    <div class="invoice-title invoice">
                        <h5 class="text-center mb-1 text-info"><strong>Reporte de Solicitudes por Paciente</strong></h5>
                    </div>
                  </div>
                    <div class="col-xs-6 text-left">
                        <p class="mb-0"><strong>Paciente: </strong>{{ $nombre }}</p>
                        <p class="mb-0"><strong>Fecha de Consulta: </strong>{{\Carbon\Carbon::now()->format('d-m-Y')}}</p>
                        <p class="mb-0"><strong>Edad: </strong>{{ $edad }} años.</p>
                        
                    </div>
                    <div class="col-xs-6 text-right">
                      <p class="mb-0"><strong>Cantidad Solicitudes: </strong>{{ $info->count() }}</p>
                      <p class="mb-0"><strong>Total Ingresos: </strong> {{ number_format($sumaTotal,2) }} Bs.</p>
                      <p class="mb-0"><strong>Rango de fechas: </strong>Desde: {{ \Carbon\Carbon::parse($fi)->format('d-m-Y')}} Hasta: {{ \Carbon\Carbon::parse($ff)->format('d-m-Y') }}</p>
                    </div>
                    <div class="table-responsive ">
                      <table class="table table-condensed" style="margin-top:120px">
                            <thead>
                                <tr>                                                   
                                    <th class="">#SOLICITUD</th>                 
                                    <th class="">MÉDICO</th>
                                    <th class="">ATENCIÓN</th>
                                    <th class="">TOTAL (Bs.)</th>
                                    <th class="">PAGO (Bs.)</th>
                                    <th class="text-center">DESCUENTO (Bs.)</th>
                                    <th class="">ESTADO</th>
                                    <th class="">FECHA</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($info as $r)
                                <tr>
                                    <td class="">{{$r->id_sol}}</td>
                                    <td class="">{{$r->mname}} {{ $r->mlast_name }}</td>
                                    <td class="">{{$r->attention}}</td>
                                    <td class="">{{$r->total}}</td>
                                    <td class="">{{$r->pago}}</td>
                                    <td class="">{{$r->discount}}</td>
                                    <td class="">{{$r->state_result}}</td>
                                    <td class="">{{$r->solicitud_date}}</td>                                                    
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>