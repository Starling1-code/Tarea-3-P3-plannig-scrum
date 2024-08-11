<?php

namespace App\Http\Controllers;

use App\Models\CREDITOS;
use Illuminate\Http\Request;
use DB;
use RealRashid\SweetAlert\Facades\Alert;

class FrecuenciaAgregar  extends Controller
{ 
    public function index(){


   $query=DB::table('dbo.tbl_creditos_plan_pagos')
    ->join('TBL_CREDITOS', 'TBL_CREDITOS.num_credito' , '=','tbl_creditos_plan_pagos.no_credito')
    ->join('TBL_CLIENTES', 'TBL_CLIENTES.cod_cliente', '=','TBL_CREDITOS.cod_cliente')
    ->select('tbl_creditos_plan_pagos.no_credito', 
    'TBL_CREDITOS.cod_cliente',
    'TBL_CLIENTES.nombres',
    'TBL_CLIENTES.cod_frecuencia_pago_Cuota',
    'TBL_CLIENTES.apellidos',
    'tbl_creditos_plan_pagos.estado',
    'tbl_creditos_plan_pagos.no_cuota',
    'tbl_creditos_plan_pagos.cuota',
    'tbl_creditos_plan_pagos.capital',
    'tbl_creditos_plan_pagos.INTERES',
    'tbl_creditos_plan_pagos.interes_orig',
    'tbl_creditos_plan_pagos.comision_orig',
    'tbl_creditos_plan_pagos.capital_orig',
    'tbl_creditos_plan_pagos.ajuste_fecha',
    'tbl_creditos_plan_pagos.MORA',
    'TBL_CLIENTES.tasa_mora',
    'tbl_creditos_plan_pagos.comision',
    'tbl_creditos_plan_pagos.fecha_cuota',
    'tbl_creditos_plan_pagos.otros',
    'TBL_CREDITOS.fecha_ultimo_pago',
    'TBL_CREDITOS.monto_original',
    'TBL_CREDITOS.monto_cuota',
    'TBL_CREDITOS.tasa')
    //->where('TBL_CLIENTES.cod_frecuencia_pago_Cuota', '=',  4)
    ->where('tbl_creditos_plan_pagos.estado', '=' ,'p')
    //->where('tbl_creditos_plan_pagos.no_credito', '=' , 3576 )
    //No_credito para sistema plan de pago calcular intentos fallidos 3576 geneses
    ->paginate(10);

    //return  $query;
    
    $query1= ($query ->count());
   


    return view('AgregarFrecuencia', ['Creditos'=> $query], ['count'=>$query1]  );
 // return $planPago;
    
 }
 public function Insertar(Request $request){

   $no_credito = ($request->get('num_credito'));

    $query=DB::table('dbo.tbl_creditos_plan_pagos')
    ->join('TBL_CREDITOS', 'TBL_CREDITOS.num_credito' , '=','tbl_creditos_plan_pagos.no_credito')
    ->join('TBL_CLIENTES', 'TBL_CLIENTES.cod_cliente', '=','TBL_CREDITOS.cod_cliente')
    ->select('tbl_creditos_plan_pagos.no_credito', 
    'TBL_CREDITOS.cod_cliente',
    'TBL_CLIENTES.nombres',
    'TBL_CLIENTES.cod_frecuencia_pago_Cuota',
    'TBL_CLIENTES.apellidos',
    'tbl_creditos_plan_pagos.estado',
    'tbl_creditos_plan_pagos.no_cuota',
    'tbl_creditos_plan_pagos.cuota',
    'tbl_creditos_plan_pagos.capital',
    'tbl_creditos_plan_pagos.INTERES',
    'tbl_creditos_plan_pagos.interes_orig',
    'tbl_creditos_plan_pagos.comision_orig',
    'tbl_creditos_plan_pagos.capital_orig',
    'tbl_creditos_plan_pagos.MORA',
    'TBL_CLIENTES.tasa_mora',
    'tbl_creditos_plan_pagos.comision',
    'tbl_creditos_plan_pagos.fecha_cuota',
    'tbl_creditos_plan_pagos.otros',
    'TBL_CREDITOS.fecha_ultimo_pago',
    'TBL_CREDITOS.monto_original',
    'TBL_CREDITOS.monto_cuota',
    'TBL_CREDITOS.tasa')
    //->where('TBL_CLIENTES.cod_frecuencia_pago_Cuota', '=',  4)
    ->where('tbl_creditos_plan_pagos.fecha_cuota', '<=' , today())
    ->where('tbl_creditos_plan_pagos.estado', '=' ,'p')
    //->where('tbl_creditos_plan_pagos.no_credito', '=' , 3576 )
    ->where('tbl_creditos_plan_pagos.no_credito', '=', $no_credito)->get();

    

    //return  $query;
    
    $query1= DB::select('select max(fecha_cuota) as fecha_cuota from tbl_creditos_plan_pagos where no_Credito = ?', [$no_credito]);
   // $fecha= DB::select('select fecha_cuota from tbl_creditos_plan_pagos where no_Credito = 3916 ');
   


    return view('InsertarPrestamoVen', ['Creditos'=> $query], ['count'=>$query1], );
 // return $planPago;
    
 }
    public function calcular(){
       
    // $query=DB::select('EXEC sp_prestamos_venci');
    /*$query=DB::table('dbo.TBL_CREDITOS')
    ->Join('tbl_creditos_plan_pagos', 'tbl_creditos_plan_pagos.no_credito' , '=', 'TBL_CREDITOS.num_credito')
    ->join('TBL_CLIENTES',  'TBL_CLIENTES.cod_cliente', '=' ,'TBL_CREDITOS.cod_cliente')
    ->select('tbl_creditos.cod_cliente' ,
    'tbl_creditos.num_credito',
    'tbl_creditos_plan_pagos.no_cuota',
    'tbl_creditos.fecha_ultimo_pago' , 
    'tbl_creditos_plan_pagos.interes',
    'tbl_creditos_plan_pagos.interes_orig',
    'TBL_CLIENTES.cod_frecuencia_pago_Cuota')
    ->where('tbl_creditos_plan_pagos.no_cuota' ,'=', 'TBL_CREDITOS.cuotas')
    ->where('tbl_creditos.num_credito' ,'=', 'tbl_creditos.num_credito')
    ->where('tbl_creditos_plan_pagos.estado', '=', 'P')
    ->where('tbl_creditos.estado', '<>', 4)
    ->where('TBL_CREDITOS.fecha_ultimo_pago', '<=',today())
    ->orderBy('TBL_CREDITOS.fecha_ultimo_pago', 'desc')
    ->get(); IN (117,121,125,151,158,163,168,169,172,179) 
    $query = DB::select('select tbl_creditos.cod_cliente ,
    tbl_creditos.num_credito,
    [tbl_creditos_plan_pagos].no_cuota,
    tbl_creditos.fecha_ultimo_pago , 
    [tbl_creditos_plan_pagos].interes,
    [tbl_creditos_plan_pagos].interes_orig,
    TBL_CLIENTES.cod_frecuencia_pago_Cuota
    from [TBL_CREDITOS] 
    INNER JOIN [tbl_creditos_plan_pagos] ON [tbl_creditos_plan_pagos].[no_credito] = [TBL_CREDITOS].[num_credito] 
    INNER JOIN [TBL_CLIENTES] ON [TBL_CLIENTES].[cod_cliente] = [TBL_CREDITOS].[cod_cliente]
    where tbl_creditos.num_credito = tbl_creditos.num_credito and  TBL_CREDITOS.cuotas = tbl_creditos_plan_pagos.no_cuota 
    and 
    tbl_creditos.estado <> 4  and [TBL_CREDITOS].fecha_ultimo_pago <= GETDATE()');

    //No_credito para sistema plan de pago calcular intereses 3356 berroa    
    // $query1= ($query ->count());
    //return $Query;
     return view('Calcular_interes', ['calcular' => $query] );
    }

    public function calcularserch(Request $request){
        $no_credito = ($request->get('num_credito'));

       /* $query=DB::table('dbo.TBL_CREDITOS')
        ->Join('tbl_creditos_plan_pagos', 'tbl_creditos_plan_pagos.no_credito' , '=', 'TBL_CREDITOS.num_credito')
        ->join('TBL_CLIENTES',  'TBL_CLIENTES.cod_cliente', '=' ,'TBL_CREDITOS.cod_cliente')
        ->select('tbl_creditos.cod_cliente' ,
        'tbl_creditos.num_credito',
        'tbl_creditos_plan_pagos.no_cuota',
        'tbl_creditos.fecha_ultimo_pago' , 
        'tbl_creditos_plan_pagos.interes',
        'tbl_creditos_plan_pagos.interes_orig',
        'TBL_CLIENTES.cod_frecuencia_pago_Cuota')
        ->where('tbl_creditos_plan_pagos.no_cuota' ,'=', 'TBL_CREDITOS.cuotas')
        ->where('tbl_creditos.num_credito' ,'=', )
        ->where('tbl_creditos_plan_pagos.estado', '=', 'P')
        ->where('TBL_CREDITOS.fecha_ultimo_pago', '<=',today())
        ->get(); */
       $query = DB::select('select tbl_creditos.cod_cliente ,
        tbl_creditos.num_credito,
        [tbl_creditos_plan_pagos].no_cuota,
        tbl_creditos.fecha_ultimo_pago , 
        [tbl_creditos_plan_pagos].interes,
        [tbl_creditos_plan_pagos].interes_orig,
        tbl_creditos_plan_pagos.comision_orig,
        TBL_CLIENTES.cod_frecuencia_pago_Cuota
        from [TBL_CREDITOS] 
        INNER JOIN [tbl_creditos_plan_pagos] ON [tbl_creditos_plan_pagos].[no_credito] = [TBL_CREDITOS].[num_credito] 
        INNER JOIN [TBL_CLIENTES] ON [TBL_CLIENTES].[cod_cliente] = [TBL_CREDITOS].[cod_cliente]
        where tbl_creditos.num_credito = ? and  TBL_CREDITOS.cuotas = tbl_creditos_plan_pagos.no_cuota
        and 
        tbl_creditos.estado <> 4  and [TBL_CREDITOS].fecha_ultimo_pago <= GETDATE()',[$no_credito]);
    
        //No_credito para sistema plan de pago calcular intereses 3356 berroa    
        // $query1= ($query ->count());
        //return $Query;
         return view('Calcular_interes', ['calcular' => $query] );
         // return $no_credito;
        }

    public function update(Request $request){
            $Interesc = ($request->get('Interesc'));
        $no_credito = ($request->get('num_credito'));
        $no_cuota = ($request->get('no_cuota'));
        for ($i= 0; $i < count($Interesc); $i++) {
            $DataUpdate = [
            'interes' => $Interesc[$i],
        'no_credito' => $no_credito[$i],
        'no_cuota' => $no_cuota[$i]]; 
         
        DB::update('update [tbl_creditos_plan_pagos] set [tbl_creditos_plan_pagos].interes = ?
        from  [TBL_CREDITOS] 
        INNER JOIN [tbl_creditos_plan_pagos] ON [tbl_creditos_plan_pagos].[no_credito] = [TBL_CREDITOS].[num_credito] 
        INNER JOIN [TBL_CLIENTES] ON [TBL_CLIENTES].[cod_cliente] = [TBL_CREDITOS].[cod_cliente]
        where tbl_creditos_plan_pagos.no_credito = ? and tbl_creditos_plan_pagos.no_cuota = ?
        and 
        tbl_creditos.estado <> 4  and [TBL_CREDITOS].fecha_ultimo_pago <= GETDATE()' , [$Interesc[$i],$no_credito[$i],$no_cuota[$i] ] );
        }

     //$interesa = ($Interesc->count());
     // dd($request->all());
     return  "actualizacion Realizada";  
    }
    public function filtros(Request $request){
            $buscarpor =($request->get('buscarpor'));

          /*  $query2=DB::table('dbo.tbl_creditos_plan_pagos')
            ->join('TBL_CREDITOS', 'TBL_CREDITOS.num_credito' , '=','tbl_creditos_plan_pagos.no_credito')
            ->join('TBL_CLIENTES', 'TBL_CLIENTES.cod_cliente', '=','TBL_CREDITOS.cod_cliente')
            ->select('tbl_creditos_plan_pagos.no_credito', 
            'tbl_creditos_plan_pagos.estado',
            'TBL_CLIENTES.nombres',
            'tbl_creditos_plan_pagos.no_cuota',
            'TBL_CREDITOS.fecha_ultimo_pago',
            'tbl_creditos_plan_pagos.fecha_cuota')
            //->where('TBL_CLIENTES.cod_frecuencia_pago_Cuota', '=',  4)
            //->where('tbl_creditos_plan_pagos.fecha_cuota', '<=' , today())
            ->where('tbl_creditos_plan_pagos.estado', '=' ,'p')
            //->where('tbl_creditos_plan_pagos.no_credito', '=' , 3576 )
            ->where('tbl_creditos_plan_pagos.no_credito', '=', $buscarpor)->get();*/
    
           
        $query=DB::table('dbo.tbl_creditos_plan_pagos')
        ->join('TBL_CREDITOS', 'TBL_CREDITOS.num_credito' , '=','tbl_creditos_plan_pagos.no_credito')
        ->join('TBL_CLIENTES', 'TBL_CLIENTES.cod_cliente', '=','TBL_CREDITOS.cod_cliente')
        ->select('tbl_creditos_plan_pagos.no_credito', 
        'TBL_CREDITOS.cod_cliente',
        'TBL_CLIENTES.nombres',
        'TBL_CLIENTES.cod_frecuencia_pago_Cuota',
        'TBL_CLIENTES.apellidos',
        'tbl_creditos_plan_pagos.estado',
        'tbl_creditos_plan_pagos.no_cuota',
        'tbl_creditos_plan_pagos.cuota',
        'tbl_creditos_plan_pagos.capital',
        'tbl_creditos_plan_pagos.INTERES',
        'tbl_creditos_plan_pagos.interes_orig',
        'tbl_creditos_plan_pagos.comision_orig',
        'tbl_creditos_plan_pagos.capital_orig',
        'tbl_creditos_plan_pagos.MORA',
        'TBL_CLIENTES.tasa_mora',
        'tbl_creditos_plan_pagos.comision',
        'tbl_creditos_plan_pagos.fecha_cuota',
        'tbl_creditos_plan_pagos.otros',
        'TBL_CREDITOS.fecha_ultimo_pago')
        //->where('TBL_CLIENTES.cod_frecuencia_pago_Cuota', '=',  4)
        //->where('tbl_creditos_plan_pagos.fecha_cuota', '<=' , today())
        ->where('tbl_creditos_plan_pagos.estado', '=' ,'p')
        //->where('tbl_creditos_plan_pagos.no_credito', '=' , 3576 )
        ->where('tbl_creditos_plan_pagos.no_credito', '=', $buscarpor)
        ->orderBy('tbl_creditos_plan_pagos.no_cuota',  'desc')
        ->get();
       
        $query1= ($query ->count());

       /* foreach($query2 as $l){
            // $consulta = $l->fecha_cuota;
             if ($l->fecha_cuota >= today()){
                return view('clientesfiltros', ['Creditos'=> $query2], ['count'=>$query1]);
             }
         }*/

            return view('Frecuencia', ['Creditos'=> $query], ['count'=>$query1]);
        
      
        //return $consulta;
        }
    public function filtrosTipo(Request $request){

            $NumeroCredito = trim($request->get('NumeroCredito'));
        $CodCliente = trim($request->get('CodCliente'));
        $Estado = trim($request->get('Estado')); 
        $Fecha = trim($request->get('Fecha'));
        if (empty($Fecha)){
            $query=DB::table('dbo.tbl_creditos_plan_pagos')
        ->join('TBL_CREDITOS', 'TBL_CREDITOS.num_credito' , '=','tbl_creditos_plan_pagos.no_credito')
        ->join('TBL_CLIENTES', 'TBL_CLIENTES.cod_cliente', '=','TBL_CREDITOS.cod_cliente')
        ->select('tbl_creditos_plan_pagos.no_credito', 
        'TBL_CREDITOS.cod_cliente',
        'TBL_CLIENTES.nombres',
        'tbl_creditos_plan_pagos.cuota',
        'tbl_creditos_plan_pagos.INTERES',
        'tbl_creditos_plan_pagos.MORA',
        'TBL_CLIENTES.tasa_mora',
        'tbl_creditos_plan_pagos.comision',
        'tbl_creditos_plan_pagos.estado',
        'tbl_creditos_plan_pagos.fecha_cuota',
        'TBL_CREDITOS.monto_original',
        'TBL_CREDITOS.tasa')
        ->where('tbl_creditos_plan_pagos.no_credito', $NumeroCredito)
        ->where('TBL_CREDITOS.cod_cliente', $CodCliente)
        ->where('tbl_creditos_plan_pagos.estado', '=', $Estado)
        ->paginate($this::PAGINACION);
        }

  /*$query=DB::table('dbo.tbl_creditos_plan_pagos')
    ->join('TBL_CREDITOS', 'TBL_CREDITOS.num_credito' , '=','tbl_creditos_plan_pagos.no_credito')
    ->join('TBL_CLIENTES', 'TBL_CLIENTES.cod_cliente', '=','TBL_CREDITOS.cod_cliente')
    ->select('tbl_creditos_plan_pagos.no_credito', 
    'TBL_CREDITOS.cod_cliente',
    'TBL_CLIENTES.nombres',
    'tbl_creditos_plan_pagos.cuota',
    'tbl_creditos_plan_pagos.INTERES',
    'tbl_creditos_plan_pagos.MORA',
    'TBL_CLIENTES.tasa_mora',
    'tbl_creditos_plan_pagos.comision',
    'tbl_creditos_plan_pagos.estado',
    'tbl_creditos_plan_pagos.fecha_cuota',
    'TBL_CREDITOS.monto_original',
    'TBL_CREDITOS.tasa')
    ->where('tbl_creditos_plan_pagos.no_credito', $NumeroCredito)
    ->where('TBL_CREDITOS.cod_cliente', $CodCliente)
    ->where('tbl_creditos_plan_pagos.estado', '=', $Estado)
    ->paginate($this::PAGINACION);*/
    $query1= ($query ->count());
    return view('index', ['Creditos'=> $query], ['count'=>$query1]);;
 }
    public function UpdatePlanPago(Request $request){

           $nocredito  = ($request->get('nocredito'));
           $cuota  = ($request->get('cuota'));
           $seguro  = ($request->get('seguro'));           

      
      $query = DB::table('dbo.tbl_creditos_plan_pagos')
      ->where('tbl_creditos_plan_pagos.no_credito', '=',  $nocredito)
      ->where('tbl_creditos_plan_pagos.estado', '=' ,'p')
      ->update(array(
          'tbl_creditos_plan_pagos.comision' => $seguro,
          'tbl_creditos_plan_pagos.comision_orig' => $seguro,
          'tbl_creditos_plan_pagos.cuota' => $cuota
          ));

          $query = DB::table('dbo.tbl_creditos')
      ->where('tbl_creditos.num_Credito', '=',  $nocredito)
      ->where('tbl_creditos.estado' , '<>', 4)
      ->update(array('tbl_creditos.monto_Cuota' => $cuota));

         /*$query1 = DB::table('dbo.tbl_creditos_plan_pagos')
         ->where('tbl_creditos_plan_pagos.no_cuota', $no_cuota[$i])
          ->where('tbl_creditos_plan_pagos.no_credito', $buscarpor[$i])
          ->where('tbl_creditos_plan_pagos.fecha_cuota', '<=' , today())
          ->where('tbl_creditos_plan_pagos.estado', '=' ,'p')
          ->update(array('tbl_creditos_plan_pagos.cuota' => $cuota[$i]));*/
    

         
       
          //Alert::toast('Seguro agregado con exito','success');
          Alert::success('Seguro agregado con exito', 'success');

           //dd($request->all());
          return Redirect()->back();
             //return    ($seguro);
             
    }

    public function ActualizarC(Request $request){

        $comision_orig = ($request->get('Comi_Orig'));
        $buscarpor    = ($request->get('buscarpor'));

        $query1 = DB::table('dbo.tbl_clientes')
         ->where('tbl_clientes.cod_cliente', $buscarpor)
         ->update(array('tbl_clientes.cod_frecuencia_pago_Cuota' =>  $comision_orig));


         

       // dd($request->all());
       Alert::success('Frecuencia agregada con exito', 'success');
       return  Redirect()->back();
    }

    public function InsertarCuota(Request $request){
        $no_credito = ($request->get('no_credito'));
        $no_cuota = ($request->get('no_cuota'));
        $interes  = ($request->get('interes')); 
        $fecha_cuota = ($request->get('fecha_cuota'));
        $comision = ($request->get('comision'));
        $mora = ($request->get('mora'));
        $otros =  ($request->get('otros'));
        $ajuste_fecha = ($request->get('ajuste_fecha'));
        $cuota = ($request->get('cuota'));

       

        for ($i= 0; $i < count($no_cuota); $i++) {
            $DataUpdate = [
            'no_credito' => $no_credito[$i],
            'cuota' => $cuota[$i],
            'interes' => $interes[$i],
            'ajuste_fecha' => $ajuste_fecha[$i],
            'otros' => $otros[$i],
            'mora' => $mora[$i],
            'comision' => $comision[$i],
            'fecha_cuota' => $fecha_cuota[$i],
            'no_cuota' => $no_cuota[$i]
        ]; 


        DB::insert('insert into tbl_creditos_plan_pagos (no_credito, no_cuota, cuota, capital, interes, saldo, fecha_cuota, comision, mora, estado, ajuste_fecha, otros ) values (?,?,?,?,?,?,?,?,?,?,?,?)', [$no_credito[$i], $no_cuota[$i],$cuota[$i] + $mora[$i], 0.00,$interes[$i],0.00,$fecha_cuota[$i],$comision[$i] + $otros[$i],$mora[$i],'P',$ajuste_fecha[$i],$otros[$i]]);
        }
        //dd($request->all());
        return  Redirect()->back();
    } 
}
