<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <title>Solicitud-{{$id}}</title>
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
      margin: 160px 100px;
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
                        <h5 class="text-center mb-1 text-info"><strong>PROFORMA DE EXÁMENES</strong></h5>
                    </div>
                  </div>
                    @foreach ($info as $i)                
                    <div class="col-xs-6">
                        <p class="mb-0"><strong>Paciente: </strong>{{ $i->paciente }}</p>
                        <p class="mb-0"><strong>CI: </strong>{{ $i->nro_ci }}<strong> Edad: </strong>{{ \Carbon\Carbon::parse($i->date_nac )->age }} años</p>
                        <p class="mb-0"><strong>Médico: </strong>{{ $i->medico }}</p>
                        <p class="mb-0"><strong>Fecha Solicitud: </strong>{{ $i->fecha_solicitud }}</p>
                    </div>
                    <div class="col-xs-6 text-right">
                        <p class="mb-0"><strong>#Solicitud: </strong>{{ $i->num_orden }}</p>
                        <p class="mb-0"><strong>Pago a cuenta: </strong>{{ $i->pago }} Bs.</p>
                        <p class="mb-0"><strong>Saldo a pagar: </strong>{{ $i->saldo_pagar }} Bs.</p>
                        <p><strong>Total: </strong>{{ $i->total }} Bs.</p>
                        <hr>
                    </div>
                    @php
                        $attention = $i->attention;
                    @endphp
                    @endforeach
                    <div class="table-responsive">
                        <table class="table table-condensed" style="margin-top:150px">
                            <thead>
                                <tr>
                                    <td><strong></strong></td>
                                    <td class="text-left text-info"><strong>ESTUDIOS</strong></td>
                                    <td class="text-center text-info"><strong>TIPO</strong></td>
                                    <td class="text-right text-info"><strong>PRECIO</strong></td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($examenes as $e)                            
                                <tr>
                                    <td></td>
                                    <td class="text-left">{{ $e->examen }}</td>
                                    <td class="text-center">{{ $attention }}</td>
                                    <td class="text-right">{{ $e->price }} Bs.</td>
                                </tr>
                                @endforeach
                                <tr>
                                    <td class=""></td>
                                    <td class=""></td>
                                    <td class="text-center text-info"><strong>Total</strong></td>
                                    @foreach ($total as $t)
                                    <td class="text-right">{{ $t->total }} Bs.</td>
                                    @endforeach
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
