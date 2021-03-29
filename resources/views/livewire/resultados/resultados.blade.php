<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <title>Resultados-solicitud-Nro:{{$id}}</title>
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
      <p class="mb-0 text-info"><strong>LABORATORIO CLINICO "SAN GABRIEL"</strong></p>
      
    </header>
    <footer>
        <table>
          <tr>
            <td>
                <p class="izq">
                  Direccion: Av. Murillo #179  Telefono: 612015 Celular: 210212
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
                        <h5 class="text-center mb-1 text-info"><strong>RESULTADOS DE ESTUDIOS CLINICOS</strong></h5>
                        @isset($origen)
                          <p class="text-center" style="font-size: 10px;">{{ $origen }}*</p>
                        @endisset
                    </div>
                  </div>
                    @foreach ($info as $i)                
                    <div class="col-xs-6" style="margin-left:60px;">
                        <p class="mb-0"><strong>Paciente: </strong>{{ $i->paciente }}</p>
                        <p class="mb-0"><strong>CI: </strong>{{ $i->nro_ci }}<strong> Edad: </strong>{{ \Carbon\Carbon::parse($i->date_nac )->age }} años</p>
                        <p class="mb-0"><strong>Sexo: </strong>{{ $i->sex }}</p>
                    </div>
                    <div class="col-xs-6 text-right" style="margin-right:60px;">
                        <p class="mb-0"><strong>#Orden: </strong>{{ $i->num_orden }}</p>
                        <p class="mb-0"><strong>Medico: </strong>{{ $i->medico }}</p>
                        <p class="mb-0"><strong>Fecha entrega: </strong>{{ \Carbon\Carbon::now()->format('d-m-Y')}} <strong>Hora: </strong>{{ \Carbon\Carbon::now()->format('H:i')}}</p>
                    </div>
                    @endforeach
                    <div class="table-responsive">
                        <table class="table table-condensed" style="margin-top:100px">
                            <thead>
                                <tr>
                                    <td class="text-left text-info" style="font-size: 12px;"><strong>GRUPO</strong></td>
                                    <td class="text-left text-info" style="font-size: 12px;"><strong>EXÁMEN</strong></td>
                                    <td class="text-left text-info" style="font-size: 12px;"><strong>SUBGRUPO</strong></td>
                                    <td class="text-rigth text-info" style="font-size: 12px;"><strong>VALORES</strong></td>
                                    <td class="text-center text-info" style="font-size: 12px;"><strong>RESULTADO</strong></td>
                                    <td class="text-center text-info" style="font-size: 12px;"><strong>UNIDAD</strong></td>
                                    <td class="text-center text-info" style="font-size: 12px;"><strong>VN.</strong></td>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                  $examen="";
                                  $grupo="";
                                  $subgrupo="";
                                @endphp
                                @foreach ($examenes as $e)                            
                                <tr>
                                    @if($e->grupo != $grupo)
                                      <td style="padding-top:4px; padding-bottom:4px;" class="text-left">{{ $e->grupo }}</td>
                                    @else
                                      <td style="padding-top:4px; padding-bottom:4px;" class="text-left"></td>
                                    @endif
                                    @if($e->examen != $examen)
                                      <td style="padding-top:4px; padding-bottom:4px;" class="text-left">{{ $e->examen }}</td>
                                    @else
                                      <td style="padding-top:4px; padding-bottom:4px;" class="text-left"> </td>
                                    @endif
                                    @if($e->subgrupo != $subgrupo)
                                    <td style="padding-top:4px; padding-bottom:4px;" class="text-left">{{ $e->subgrupo }}</td>
                                    @else
                                      <td style="padding-top:4px; padding-bottom:4px;" class="text-left"> </td>
                                    @endif
                                
                                    <td style="padding-top:4px; padding-bottom:4px;" class="text-rigth">{{ $e->valores }}</td>
                                    <td style="padding-top:4px; padding-bottom:4px;" class="text-center">{{ $e->result }}</td>
                                    <td style="padding-top:4px; padding-bottom:4px;" class="text-center">{{ $e->unidad }}</td>
                                    <td style="padding-top:4px; padding-bottom:4px; font-size: 10px;" class="text-center">{{ $e->rango }}</td>
                                        @php
                                          $grupo = $e->grupo;
                                          $examen = $e->examen;
                                          $subgrupo = $e->subgrupo;
                                        @endphp
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
