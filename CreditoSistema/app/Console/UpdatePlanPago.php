<?php

namespace App\Console;

use Illuminate\Console;
use Illuminate\Console\Command;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use DB;

class funciones{ 


    public function updatePlan($MoraAc, $no_credito,$fechaActual,$no_cuota){
      
         $MoraAct   = $MoraAc;
         $no_credito4  =  $no_credito;
         $fechaActual1 = $fechaActual;
         $no_cuota1 = $no_cuota;
        // $INT1 = $INT;



        for ($i= 0; $i < count( $no_credito4); $i++) {
          

    $query1=DB::table('dbo.TBL_CREDITOS_PLAN_PAGOS')
    ->where('TBL_CREDITOS_PLAN_PAGOS.no_cuota', $no_cuota1[$i])
    ->where('TBL_CREDITOS_PLAN_PAGOS.no_credito', $no_credito4[$i])
    ->where('TBL_CREDITOS_PLAN_PAGOS.fecha_cuota', '<=' , today())
    ->where('TBL_CREDITOS_PLAN_PAGOS.estado', '=' ,'p')
    ->update(array('TBL_CREDITOS_PLAN_PAGOS.MORA' =>  $MoraAct[$i]));

         $query1 = DB::table('dbo.TBL_CREDITOS_PLAN_PAGOS')
         ->where('TBL_CREDITOS_PLAN_PAGOS.no_credito', $no_credito4[$i])
        //->where('TBL_CREDITOS_PLAN_PAGOS.no_cuota',  $no_cuota1[$i])
         ->where('TBL_CREDITOS_PLAN_PAGOS.fecha_cuota', '<=' , today())
         ->where('TBL_CREDITOS_PLAN_PAGOS.estado', '=' ,'p')
         ->update(array('TBL_CREDITOS_PLAN_PAGOS.ajuste_fecha' =>  $fechaActual1[$i]));

        /* $query1 = DB::table('dbo.TBL_CREDITOS_PLAN_PAGOS')
          ->where('TBL_CREDITOS_PLAN_PAGOS.no_cuota',  $no_cuota1[$i])
          ->where('TBL_CREDITOS_PLAN_PAGOS.no_credito', $no_credito4[$i])
          ->where('TBL_CREDITOS_PLAN_PAGOS.fecha_cuota', '<=' , today())
          ->where('TBL_CREDITOS_PLAN_PAGOS.estado', '=' ,'p')
          ->update(array('TBL_CREDITOS_PLAN_PAGOS.otros' =>  $INT1[$i]));*/

        }

        
 }
}


class UpdatePlanPago 
{

   
    //Funcion que permite sacar el tiempo
    function calcularTiempo($fehcaInicio, $fechaFin){
      
      $datetime1 = date_create($fehcaInicio);
      $datetime2 = date_create($fechaFin);
      $interval = date_diff($datetime1, $datetime2);
     

      $tiempo=array();

      foreach($interval as $valor){ 
          $tiempo[]=$valor;
      }
      return $tiempo;
    }
 
   
    
    public function DataPlanPago(){
        
    $query=DB::table('dbo.TBL_CREDITOS_PLAN_PAGOS')
    ->join('TBL_CREDITOS', 'TBL_CREDITOS.num_credito' , '=','TBL_CREDITOS_PLAN_PAGOS.no_credito')
    ->join('TBL_CLIENTES', 'TBL_CLIENTES.cod_cliente', '=','TBL_CREDITOS.cod_cliente')
    ->select('TBL_CREDITOS_PLAN_PAGOS.no_credito', 
    'TBL_CREDITOS.cod_cliente',
    'TBL_CLIENTES.nombres',
    'TBL_CLIENTES.cod_frecuencia_pago_Cuota',
    'TBL_CLIENTES.apellidos',
    'TBL_CREDITOS_PLAN_PAGOS.estado',
    'TBL_CREDITOS_PLAN_PAGOS.no_cuota',
    'TBL_CREDITOS_PLAN_PAGOS.cuota',
    'TBL_CREDITOS_PLAN_PAGOS.capital',
    'TBL_CREDITOS_PLAN_PAGOS.INTERES',
    'TBL_CREDITOS_PLAN_PAGOS.interes_orig',
    'TBL_CREDITOS_PLAN_PAGOS.comision_orig',
    'TBL_CREDITOS_PLAN_PAGOS.capital_orig',
    'TBL_CREDITOS_PLAN_PAGOS.ajuste_fecha',
    'TBL_CREDITOS_PLAN_PAGOS.MORA',
    'TBL_CLIENTES.tasa_mora',
    'TBL_CREDITOS_PLAN_PAGOS.comision',
    'TBL_CREDITOS_PLAN_PAGOS.fecha_cuota',
    'TBL_CREDITOS.fecha_ultimo_pago',
    'TBL_CREDITOS.monto_original',
    'TBL_CREDITOS.monto_cuota',
    'TBL_CREDITOS.tasa')
    //->where('TBL_CLIENTES.cod_frecuencia_pago_Cuota', '=',  4)
    //->where('TBL_CREDITOS_PLAN_PAGOS.ajuste_fecha', '<' , today())
    ->where('TBL_CREDITOS_PLAN_PAGOS.fecha_cuota', '<=' , today())
    ->where('TBL_CREDITOS_PLAN_PAGOS.estado', '=' ,'p')
    ->where('TBL_CREDITOS_PLAN_PAGOS.no_credito', '=' , 3894 )
    //No_credito para sistema plan de pago calcular intentos fallidos 3576 geneses
    ->paginate(10);

    //return  $query;

    $update = new funciones();
    $SacarFecha = new UpdatePlanPago();
    
    $query1= ($query ->count());
    $planPago = array();
    $cuota1 = array();
    $no_credito = array(); 
   // $años = array(); 
   // $m_p_v = array();
    $FechaAc  = array();
   
    //$texto =  date_format("y-m-d");
    $FechaFinal = today();
    

     foreach($query as $l){

     

        $p_v = 0;
        $mesesA = 12;
        $Periodo_Frecuencia = 15; 
        $dias_meses = 30;
        $dias_meses_Frec5 = 30;
        $dias_meses_Frec4 = 15;
        $dias_meses_Frec3 = 14;
        $dias_meses_Frec2 = 7;
        $TasaCuota = 10;
        $Porcentaje = 100;
        $INT_F = 100;
        $IntentosF1 = 100;
        $IntentosF_meses = 0;
        $IntentosF_dias = 100;
        $Dias_P_V = 0;
        $datos  = $SacarFecha->calcularTiempo($l->fecha_cuota, $FechaFinal);

        $años  = $datos[0];
        $meses  = $datos[1];
        $dias  = $datos[2];
        //$ajuste_fecha []  = today();

        //Variables para enviar por parametro
        $FechaAc [] =  today();
        $planPago [] = $l;
        $no_credito [] = $l->no_credito;
        $no_cuota [] = $l->no_cuota;


        //convertir fecha 
        $m_p_v   = $años * $mesesA + $meses;//De años a meses
        $Dias_Venc = ($m_p_v * $dias_meses + $dias);// De meses a dia
        $cuota = ($l->capital_orig + $l->interes_orig + $l->comision_orig);
        $Mora  = ($cuota ) * $TasaCuota / $Porcentaje;

        if($l->cod_frecuencia_pago_Cuota == 4){

          $IntentosF = $Dias_Venc /  $dias_meses_Frec4;
          $IntentosF2 = floor($IntentosF);
          
          for ($i= 0; $i < 3; $i++) {
           
          }

          if($IntentosF2 == 0 || $IntentosF2 != 0){
          
          $IntentosF2 = $IntentosF2 + 1;
          
          $INT [] = ($INT_F * $IntentosF2);
        
          }
         // $INT = ($INT_F * $IntentosF2);

         
          $Mora_periodos [] = $Mora * $IntentosF2;  

             
          }
   
       // $update->updatePlan($Mora_periodos, $no_credito,$FechaAc,$no_cuota); 
        
    }

    return   $Mora_periodos;
  
    
   
  // dd( $datos[0]);
 //dd($no_credito );

}


}
