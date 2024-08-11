<?php

namespace App\Console\Commands;

use Illuminate\Console;
use Illuminate\Console\Command;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use DB;

class funciones{ 


    public function updatePlan($prueba, $no_credito,$fechaActual){
      
         $prueba2   = $prueba;
         $no_credito4  =  $no_credito;
         $texto1 = $fechaActual;
        
    

        
        

        for ($i= 0; $i < count( $no_credito4); $i++) {
          

    $query1=DB::table('dbo.TBL_CREDITOS_PLAN_PAGOS')
    ->where('TBL_CREDITOS_PLAN_PAGOS.no_credito', $no_credito4[$i])
    ->where('TBL_CREDITOS_PLAN_PAGOS.fecha_cuota', '<=' , today())
    ->where('TBL_CREDITOS_PLAN_PAGOS.estado', '=' ,'p')
    ->update(array('TBL_CREDITOS_PLAN_PAGOS.MORA' => $prueba2[$i]));

         $query1 = DB::table('dbo.TBL_CREDITOS_PLAN_PAGOS')
         ->where('TBL_CREDITOS_PLAN_PAGOS.no_credito', $no_credito4[$i])
        //->where('TBL_CREDITOS_PLAN_PAGOS.no_cuota', $no_credito4[$i])
         ->where('TBL_CREDITOS_PLAN_PAGOS.fecha_cuota', '<=' , today())
         ->where('TBL_CREDITOS_PLAN_PAGOS.estado', '=' ,'p')
         ->update(array('TBL_CREDITOS_PLAN_PAGOS.ajuste_fecha' =>  $texto1[$i]));

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
    ->where('TBL_CREDITOS_PLAN_PAGOS.ajuste_fecha', '<' , today())
    ->where('TBL_CREDITOS_PLAN_PAGOS.fecha_cuota', '<=' , today())
    ->where('TBL_CREDITOS_PLAN_PAGOS.estado', '=' ,'p')
    //->where('TBL_CREDITOS_PLAN_PAGOS.no_credito', '=' , 3576 )
    //No_credito para sistema plan de pago calcular intentos fallidos 3576 geneses
    ->paginate(10);

    //return  $query;

    $update = new funciones();
    $SacarFecha = new UpdatePlanPago();
    
    $query1= ($query ->count());
    $planPago = array();
    $cuota1 = array();
    $no_credito = array(); 
    $años = array(); 
    $texto  = array();
   
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
        $datos  = $SacarFecha->calcularTiempo($l->fecha_cuota, $FechaFinal);
        $años [] = $datos[1];
        //$ajuste_fecha []  = today();
        $texto [] =  today();
        $planPago [] = $l;
        $no_credito [] = $l->no_credito; 
        $cuota1 [] =  $l->capital + $l->INTERES + $l->comision + $l->MORA;
        $update->updatePlan($cuota1, $no_credito,$texto); 


        
    }

   // return $texto;
  
    
   
  // dd( $datos[0]);
   //dd($no_credito );

}


}




class TestTask extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:task';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Actualizando registros';

    

 

    public function handle()
    {
      
        
        $proceso = new UpdatePlanPago();
        $proceso->DataPlanPago();
        
        
        $texto = "[" . date("y-m-d H:i:s") .  "]: Ejecutando proceso actualizar";
        Storage::append("archivo.txt",  $texto);
        //return Command::SUCCESS;
    }
}
