<?php

namespace App\Http\Controllers;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use Illuminate\Http\Request;
use App\Models\Solicitud;
use App\Models\Paciente;
use App\Models\Medico;
use App\Models\Personal;
use App\Models\Cita;
use Carbon\Carbon;
use DB;

class DashController extends Controller
{
    public function data()
    {
        $num_pacientes = Paciente::count();
        $num_medicos = Medico::count();
        $num_personal = Personal::count();
        $num_solicitudes = Solicitud::count();

        $currentYear =  date("Y");
        //ventas semana actual
          $start = date('Y-m-d', strtotime('monday this week')).' 00:00:00'; //obtenemos el 1er dia de la semana actual
          $finish = date('Y-m-d', strtotime('sunday this week')).' 23:59:59';  //obtenemos el ultimo dia
                
          //dd($finish);
          $d1 = strtotime($start); //convertir fecha inicial en formato unix
          $d2 = strtotime($finish); 
          $array = array(); 
      
          for ($currentDate = $d1; $currentDate <= $d2; $currentDate += (86400)) 
          { 
            $dia = date('Y-m-d', $currentDate); //convertimos el dia unix a formato ingles
            $array[] = $dia;            
          } 
      

        $sql ="SELECT d.fecha, IFNULL(c.total,0) as total FROM (
            SELECT '$array[0]' AS fecha 
            UNION 
            SELECT '$array[1]' AS fecha 
            UNION 
            SELECT '$array[2]' AS fecha 
            UNION 
            SELECT '$array[3]' AS fecha 
            UNION 
            SELECT '$array[4]' AS fecha
            UNION
            SELECT '$array[5]' AS fecha
            UNION
            SELECT '$array[6]' AS fecha
          ) d
          LEFT JOIN(
          SELECT SUM(pago)AS total, DATE(created_at)AS fecha FROM solicitudes WHERE created_at BETWEEN '$start' AND '$finish' 
          GROUP BY DATE(created_at)
        )c  ON d.fecha = c.fecha";
        
        $weekSales = DB::select(DB::raw($sql));
        
 

        $chartIngresoSemanal = new LarapexChart();
        $chartIngresoSemanal->setTitle('Ingresos Semana Actual')
        ->setLabels(['Lun.','Mar.','Mié.','Jue.','Vie.','Sáb.','Dom.'])
        ->setType('donut')        
        ->setDataset([
          intval($weekSales[0]->total),
          intval($weekSales[1]->total),
          intval($weekSales[2]->total),
          intval($weekSales[3]->total),
          intval($weekSales[4]->total),
          intval($weekSales[5]->total),
          intval($weekSales[6]->total),
        ]);
        

        
        //ingresos por mes
        $salesByMonth = DB::select(DB::raw("
        SELECT m.MONTH AS MES, IFNULL(c.ingresos,0)AS INGRESOS, IFNULL(c.solicitudes,0) as TRANSACCIONES  FROM(
        SELECT 'January' AS MONTH  UNION  SELECT 'February' AS MONTH 
        UNION   SELECT 'March' AS MONTH  UNION 
        SELECT 'April' AS MONTH  UNION  SELECT 'May' AS MONTH 
        UNION  SELECT 'june' AS MONTH  UNION 
        SELECT 'July' AS MONTH  UNION  SELECT 'August' AS MONTH 
        UNION  SELECT 'September' AS MONTH  UNION 
        SELECT 'October' AS MONTH  UNION  SELECT 'November' AS MONTH 
        UNION  SELECT 'December' AS MONTH 
        )m
        left join(
        SELECT MONTHNAME(created_at) AS MONTH, COUNT(*) AS solicitudes, SUM(pago)AS ingresos 
        FROM solicitudes 
        WHERE YEAR(created_at)=$currentYear
        GROUP BY MONTHNAME(created_at),MONTH(created_at) 
        ORDER BY MONTH(created_at)
        )  c ON m.MONTH =c.MONTH
        "));  


        $chartIngresoxMes = (new LarapexChart)->setType('area')
        ->setTitle('Ingresos Anuales')
        ->setSubtitle('Por Mes')
        ->setColors(['#725298'])
        ->setGrid(true)
        ->setXAxis([
        'Enero', 'Febrero', 'Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'
        ])
        ->setDataset([
        [
        'name'  =>  'Ingresos',
        'data'  =>  
        [
            $salesByMonth[0]->INGRESOS,
            $salesByMonth[1]->INGRESOS,
            $salesByMonth[2]->INGRESOS,
            $salesByMonth[3]->INGRESOS,
            $salesByMonth[4]->INGRESOS,
            $salesByMonth[5]->INGRESOS,
            $salesByMonth[6]->INGRESOS,
            $salesByMonth[7]->INGRESOS,
            $salesByMonth[8]->INGRESOS,
            $salesByMonth[9]->INGRESOS,
            $salesByMonth[10]->INGRESOS,
            $salesByMonth[11]->INGRESOS
        ]
        ]
        ]);

        //citas
        $citas = Cita::whereDate('start',Carbon::now()->format('Y-m-d'))->get();
        //estado solicitudes
        $num_solicitudes = Solicitud::count();
        $sol_sin_transcribir = Solicitud::where('state_result','RECEPCIONADO')->count();
        $sol_sin_entregar = Solicitud::where('state_result','TRANSCRITO')->count();
        //ingresos
        $total_ingresos = Solicitud ::sum('pago');
        $total_ingresos_semanales = Solicitud::whereBetween('created_at',[$start,$finish])->sum('pago');
        //medicos 
        $solicitudes_medicos = Solicitud::leftjoin('medicos as m','m.id','solicitudes.medic')
                                ->select('m.name','m.last_name',DB::raw('Count(solicitudes.medic) as num_sol'))
                                ->where('m.name','!=','A quien corresponda')
                                ->groupBy('m.name','m.last_name')
                                ->orderBy('num_sol','desc')->get()->take(10);
 
        return view('dash', compact('chartIngresoSemanal',
                                    'chartIngresoxMes',
                                    'num_pacientes',
                                    'num_medicos',
                                    'num_personal',
                                    'num_solicitudes',
                                    'citas',
                                    'num_solicitudes',
                                    'sol_sin_transcribir',
                                    'sol_sin_entregar',
                                    'total_ingresos',
                                    'total_ingresos_semanales',
                                    'solicitudes_medicos'
                                    )
                                  );
    }

}
