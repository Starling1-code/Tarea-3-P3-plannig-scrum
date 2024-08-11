@section('content')
  @include('menu')
  <h1>Bienvenido a mi sitio web</h1>
  <p>Este es el contenido de mi página de inicio.</p>
@endsection


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/styles.css" />
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <!-- CSS only -->
    <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

    <link
      href="https://fonts.googleapis.com/css2?family=Raleway&display=swap"
      rel="stylesheet"
    />
    <title>Table</title>
  </head>
  <body>
    <div class="super">
    <div class="container">
      <div class="table_header">
        <h2>Clientes</h2> 
        @php 
        $FechaActual = today();
        $StatusCuotas = "update";
        @endphp
       <button  id="getmodal">Total</button>
      <div class="input_search">
        <form action="/credito/serch" method="GET">
          <input class="search1" type="search" placeholder="Buscar" name="buscarpor" id="buscarpor" value=""/>
          <button type="submit">buscar</button>
        </form>
       </div>
      </div>
      <div class="scroll">
      <section>
      <table class="tbodyScroll">
        <thead>
           <tr>
             <th>marcar</th>
              <th>Clie</th>
              <th>Cod</th>
              <th>NOMBRE</th>
              <th>APELLIDO</th>
              <th>Facha</th>
              <th>NO.CUOTA</i></th>
              <th>CUOTA_R</i></th>
              <th>CAPITAL</th>
              <th>INTERES</th>
              <th>SEGURO</th>
              <th>MORA</th>
              <th>Periodo pago</th>
              <th class="overthead">CUOTA_O</i></th>
              <th class="overthead">CAPITAL</th>
              <th class="overthead">INTERES</th>
              <th class="overthead">SEGURO</th>
              <th class="overthead">MORA</th>
              <th class="overthead">Fecha</th>
              <th class="overthead">Dias_Ven</th>
              <th class="overthead">Periodo_V</th>
              <th class="overthead">Intentos.F</th>
              <th class="overthead">fecha_ven</th>

           </tr>
        </thead>
      <tbody>   
        @php
        //Variables para sumar total de cada columna 
          $sumador_mora = 0;
          $sumador_seguro = 0;
          $sumador_interes = 0;
          $sumador_capital = 0;
          $sumador_cuota = 0;
          $sumador_inten = 0;

          $FechaFinal = today();

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
          @endphp
          
          <form action=" {{route('credito.UpdatePlanPago')}}" method="get">
        @foreach($Creditos as $l)
     
          <tr>
          @php
    
        
         if($l->ajuste_fecha <> null){

          $sumador_periodos = 0;
          $p_v = 0;
          $mesesA = 12;
          $Periodo_Frecuencia = 15; 
          $dias_meses = 30;
          $dias_meses_Frec5 = 30;
          $dias_meses_Frec4 = 15;
          $dias_meses_Frec3 = 14;
          $dias_meses_Frec2 = 7;
         // $cuota =  $l->capital + $l->INTERES + $l->comision + $l->MORA;

           $datos = calcularTiempo($l->ajuste_fecha, $FechaFinal);
         // $datos = calcularTiempo($l->fecha_ultimo_pago, $FechaFinal);
         /* //Calcular intereses
          $cal_tiempo = calcularTiempo($l->fecha_ultimo_pago, $FechaFinal);
          $añosi = $cal_tiempo[0];
          $mesesi = $cal_tiempo[1];
          $diasi = $cal_tiempo[2];
          $Interesc = 0;
          $m_venc_Pago = $añosi * $mesesA + $mesesi;
          $d_venc_Pago = $m_venc_Pago * $dias_meses;
          $d_venc_Pago = $d_venc_Pago + $diasi;
          $periodos_interes = floor($d_venc_Pago / $dias_meses_Frec4);*/

          //Frecuencia 5 pagos mensuales 
          $años = $datos[0];
          $meses = $datos[1];
          $dias = $datos[2];
          $INT_F = 100;
         // $IntentosF1 = 100;
          $IntentosF_meses = 0;
          //$IntentosF_dias = 100;
          $Dias_P_V = 0;

          //Conversion de fecha 
          $m_p_v = $años * $mesesA + $meses;//De años a meses
          $Dias_Venc = ($m_p_v * 30); //De meses a dias
          $Dias_Venc = $Dias_Venc + $dias;
          //Calcular Mora 
          /* 
          Mora es igual a Capital + intereses + seguro, luego se le multiplica 10%  y por ultimo 
          se a este resultado se multiplica por la cantidad de periodos 
          */ 
        /*  $cuota = ($l->capital_orig + $l->interes_orig + $l->comision_orig + $l->otros);
          $TasaCuota = 10;
          $Porcentaje = 100;
          $Mora = ($cuota) * $TasaCuota / $Porcentaje;*/
      }else {

        $sumador_periodos = 0;
          $p_v = 0;
          $mesesA = 12;
          $Periodo_Frecuencia = 15; 
          $dias_meses = 30;
          $dias_meses_Frec5 = 30;
          $dias_meses_Frec4 = 15;
          $dias_meses_Frec3 = 14;
          $dias_meses_Frec2 = 7;
         // $cuota =  $l->capital + $l->INTERES + $l->comision + $l->MORA;
  

          $datos = calcularTiempo($l->fecha_cuota, $FechaFinal);

           /* //Calcular intereses
          $cal_tiempo = calcularTiempo($l->fecha_ultimo_pago, $FechaFinal);
          $añosi = $cal_tiempo[0];
          $mesesi = $cal_tiempo[1];
          $diasi = $cal_tiempo[2];
          $Interesc = 0;
          $m_venc_Pago = $añosi * $mesesA + $mesesi;
          $d_venc_Pago = $m_venc_Pago * $dias_meses;
          $d_venc_Pago = $d_venc_Pago + $diasi;
          $periodos_interes = floor($d_venc_Pago / $dias_meses_Frec4);*/

          //Frecuencia 5 pagos mensuales 
          $años = $datos[0];
          $meses = $datos[1];
          $dias = $datos[2];
          $INT_F = 100;
         // $IntentosF1 = 100;
          $IntentosF_meses = 0;
          //$IntentosF_dias = 100;
          $Dias_P_V = 0;

          //Conversion de fecha 
          $m_p_v = $años * $mesesA + $meses;//De años a meses
          $Dias_Venc = ($m_p_v * 30); //De meses a dias
          $Dias_Venc = $Dias_Venc + $dias;
          //Calcular Mora 
          /* 
          Mora es igual a Capital + intereses + seguro, luego se le multiplica 10%  y por ultimo 
          se a este resultado se multiplica por la cantidad de periodos 
          */ 
        /*  $cuota = ($l->capital_orig + $l->interes_orig + $l->comision_orig + $l->otros);
          $TasaCuota = 10;
          $Porcentaje = 100;
          $Mora = ($cuota) * $TasaCuota / $Porcentaje;*/
     
      }
          if($l->cod_frecuencia_pago_Cuota == 5){

            $FrecPeriodo = 'Mensual';

            $IntentosF = $Dias_Venc /  $dias_meses_Frec5;
          $IntentosF2 = number_format($IntentosF, 2, '.', '');

          if($IntentosF2 == 0 ){
           
          $IntentosF2 = $IntentosF2 + 1;
          
          $IntentosF2 = number_format($IntentosF, 2, '.', '');
        
          }
          $INT = ($INT_F * $IntentosF2);
         
          $cuota = ($l->capital_orig + $l->interes_orig + $l->comision_orig +  $INT);
          $TasaCuota = 10;
          $Porcentaje = 100;
          $Mora = ($cuota) * $TasaCuota / $Porcentaje;

         

          if($l->ajuste_fecha <> null){
              $INTE = $l->comision + $INT;

              $Mora_periodos = $Mora * ($Dias_Venc / 30) + $l->MORA;

              $CuotaInsertar = ($l->capital + $l->INTERES + $l->comision  + $INT + $Mora_periodos );
           } else {

            $INTE = $l->comision_orig + $INT;
            $Mora_periodos = $Mora * ($Dias_Venc / 30);
            $CuotaInsertar = ($l->capital + $l->INTERES + $l->comision + $Mora_periodos + $INT);
            }

            // $Mora_periodos = floor($Mora_periodos);
            
           //   $Mora_periodos = $Mora * $IntentosF2;
       
       
        }elseif($l->cod_frecuencia_pago_Cuota == 4){

          $FrecPeriodo = 'Quincenal';

          $IntentosF = $Dias_Venc /  $dias_meses_Frec4;
          $IntentosF2 = number_format($IntentosF, 2, '.', '');

          if($IntentosF2 == 0 ){
           
          $IntentosF2 = $IntentosF2 + 1;
          
          $IntentosF2 = number_format($IntentosF, 2, '.', '');
        
          }
          $INT = ($INT_F * $IntentosF2);
         
          $cuota = ($l->capital_orig + $l->interes_orig + $l->comision_orig +  $INT);
          $TasaCuota = 10;
          $Porcentaje = 100;
          $Mora = ($cuota * $TasaCuota) / $Porcentaje;

         

          if($l->ajuste_fecha <> null){
              $INTE = $l->comision + $INT;

              $Mora_periodos = $Mora * ($Dias_Venc / 30) + $l->MORA;

              $CuotaInsertar = ($l->capital + $l->INTERES + $l->comision  + $INT + $Mora_periodos );
              } 
              else {

                $INTE = $l->comision_orig + $INT;
                $Mora_periodos = $Mora * ($Dias_Venc / 30);
              $CuotaInsertar = ($l->capital + $l->INTERES + $l->comision + $Mora_periodos + $INT);
              }

            // $Mora_periodos = floor($Mora_periodos);
            
           //   $Mora_periodos = $Mora * $IntentosF2;
 
             
          }elseif($l->cod_frecuencia_pago_Cuota == 3){
            $FrecPeriodo = 'Catorcenal';

          $IntentosF = $Dias_Venc /  $dias_meses_Frec3;
          $IntentosF2 = number_format($IntentosF, 2, '.', '');

          if($IntentosF2 == 0 || $IntentosF2 != 0){
          
          $IntentosF2 = $IntentosF2 + 1;

        

          }
          $INT = ($INT_F * $IntentosF2);

          $cuota = ($l->capital_orig + $l->interes_orig + $l->comision_orig +  $INT);
          $TasaCuota = 10;
          $Porcentaje = 100;
          $Mora = ($cuota) * $TasaCuota / $Porcentaje;

          if($l->ajuste_fecha <> null){
              $INTE = $l->comision + $INT;

              $Mora_periodos = $Mora * ($Dias_Venc / 30) + $l->MORA;

              $CuotaInsertar = ($l->capital + $l->INTERES + $l->comision  + $INT + $Mora_periodos );
           } else {

            $INTE = $l->comision + $INT;
            $Mora_periodos = $Mora * ($Dias_Venc / 30);
            $CuotaInsertar = ($l->capital + $l->INTERES + $l->comision + $Mora_periodos + $INT);
            }

          

            // $Mora_periodos = floor($Mora_periodos);
            
          //   $Mora_periodos = $Mora * $IntentosF2;

          $CuotaInsertar = ($l->capital + $l->INTERES + $l->comision + $Mora_periodos + $INT);
          
          }elseif($l->cod_frecuencia_pago_Cuota == 2){

            $FrecPeriodo = 'Semanal';

          $IntentosF = $Dias_Venc /  $dias_meses_Frec2;
          $IntentosF2 = floor($IntentosF);

          if($IntentosF2 == 0 ){
           
           $IntentosF2 = $IntentosF2 + 1;
           
           $IntentosF2 = number_format($IntentosF, 2, '.', '');
         
           }
        
          
          $INT = ($INT_F * $IntentosF2);

          $cuota = ($l->capital_orig + $l->interes_orig + $l->comision_orig +  $INT);
          $TasaCuota = 10;
          $Porcentaje = 100;
          $Mora = ($cuota) * $TasaCuota / $Porcentaje;
         
          
           //$Mora_periodos = $Mora * $IntentosF2;
           if($l->ajuste_fecha <> null){
              $INTE = $l->comision + $INT;

              $Mora_periodos = $Mora * ($Dias_Venc / 30) + $l->MORA;

              $CuotaInsertar = ($l->capital + $l->INTERES + $l->comision  + $INT + $Mora_periodos );
           } else {

            $INTE = $l->comision + $INT;
            $Mora_periodos = $Mora * ($Dias_Venc / 30);
            $CuotaInsertar = ($l->capital + $l->INTERES + $l->comision + $Mora_periodos + $INT);
            }

            
          } 
          

        

        if($l->ajuste_fecha <> null){

          $sumador_mora    = $sumador_mora  + $Mora_periodos + $l->MORA;
       // $sumador_mora    = $sumador_mora    + $l->MORA;
        $sumador_seguro  =  $sumador_seguro + $l->comision;
        $sumador_interes = $sumador_interes + $l->INTERES;
        $sumador_capital = $sumador_capital + $l->capital;
        $sumador_inten   = $sumador_inten   +  $INT;

       
          $total = $sumador_mora + $sumador_seguro + $sumador_interes + $sumador_capital + $sumador_inten;
          } 
          else {

          $sumador_mora    = $sumador_mora    + $Mora_periodos;
       // $sumador_mora    = $sumador_mora    + $l->MORA;
        $sumador_seguro  =  $sumador_seguro + $l->comision;
        $sumador_interes = $sumador_interes + $l->INTERES;
        $sumador_capital = $sumador_capital + $l->capital;
        $sumador_inten   = $sumador_inten   +  $INT;
        $total = $sumador_mora + $sumador_seguro + $sumador_interes + $sumador_capital + $sumador_inten;
          }
        

        $total = number_format($total);

          @endphp
            <td>
                <div class="swtich-container1">
                <input class="form-check-input " type="checkbox" name="buscarpor[]" value="{{$l->no_credito}}" >  
               </div>    
            </td>
            <td>{{$l->cod_cliente}}</td>
            <td>{{$l->no_credito}}</td>
            <td>{{$l->nombres}}</td>
            <td>{{$l->apellidos}}</td>
            <td>{{\Carbon\Carbon::parse($l->fecha_cuota)->format('d/m/Y') }}</td>
            <td><input class="editint" type="number" name="no_cuota[]"  value="{{$l->no_cuota}}"></td>
            <td>{{$l->cuota}}</td>
            <td>{{$l->capital}}</td>
            <td>{{$l->INTERES}}</td>
            <td>{{$l->comision}}</td>
            <td>{{$l->MORA}}</td>
            <td>{{$FrecPeriodo}}</td>
            <td><input class="editint" type="number" name="cuota[]"  value="{{$CuotaInsertar =   number_format($CuotaInsertar, 2, '.', '')}}"></td>
            <td>{{$l->capital}}</td>
            <td>{{$l->INTERES}}</td>
            <td><input class="editint" type="number" name="interes[]"  value="{{ $INTEN =   number_format($INTE, 2, '.', '')}}"></td>
            <td><input class="editint" type="number" name="moraperiodo[]"  value="{{ $Mora_periodos =   number_format($Mora_periodos, 2, '.', '')}}"></td>
            <td>{{\Carbon\Carbon::parse($l->fecha_ultimo_pago)->format('d/m/Y') }}</td>
            <td>{{$Dias_Venc}}</td> 
            <td>{{$IntentosF2}}</td>
            <td><input class="editint" type="number" name="INT[]"  value="{{number_format($INT, 2, '.', '')}}"></td>
            <td><input class="editint"  name="ajuste_fecha[]"  value="{{$FechaActual}}"></td>
            <td><input type="hidden" class="editint"  name="StatusCuota[]"  value="{{$StatusCuotas}}"></td>
            
            @if ($l->fecha_ultimo_pago <= $FechaFinal)
            
            @endif
            </tr>
            
        
          @endforeach
          <button type="submit" class="btnInt">Actualizar</button>
          </form>
        </tbody>
      </table>
    </section>
    </div>
    <div class="table_fotter d-flex justify-content-center">       
     
      <a href="{{route('credito.index')}}"> <button type="submit" class="btnVolver">Volver</button> </a>
      
      @if ($l->fecha_ultimo_pago <= $FechaFinal)
      <form action=" {{route('credito.calcularSerch')}}" method="get">
      <input class="form-check-input " type="checkbox" name="num_credito" value="{{$l->no_credito}}">
       <button type="submit" class="Calcular">Calcular intereses</button> 
      </form>
      @endif
      </div>
        @if (empty($l->comision_orig))
        <form action=" {{route('credito.ActualizarC')}}" method="get">
        <label for="" class="comision">Comision_Orig</label>
        <input class="CoOrig"  type="checkbox" name="buscarpor" value="{{$l->no_credito}}" >  
        <input class="CoOrig" type="text" type="number" name="Comi_Orig">
        <button type="submit" class="CoOrig1">Actualizar</button>
      </form>
        @endif
      </div>
      <p class="total">Total Pendientes : {{$count}}</p>
      </div>
  </div>
  <section class="modal ">
      <div class="modal_container">
        <label for="">cuota</label>
        <input type="text"  value="{{number_format($sumador_cuota)}}">
        <label for="">Capital</label>
        <input type="text"  value="{{number_format($sumador_capital)}}">
        <label for="">intereses</label>
        <input type="text"  value="{{number_format($sumador_interes)}}">
        <label for="">seguro</label>
        <input type="text"  value="{{number_format($sumador_seguro)}}">
        <label for="">Mora</label>
        <input type="text"  value="{{number_format($sumador_mora)}}">
        <label for="">Intentos fallidos</label>
        <input type="text"  value="{{number_format($sumador_inten)}}">
        <label for="">total</label>
        <input type="text"  value="{{$total}}">
        <a type="button" class="modal_close">Cerrar</a>
      </div> 
    </section>
    
    
  @if($l->fecha_ultimo_pago >= $FechaFinal)
 <p class="vencimiento">Prestamo vigente</p>
  @else
  <p class="vencimiento">prestamo vencido</p>
  @endif


    </div> 
    <script src="js/main.js"></script>
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css"
    />
  </body>

  @include('sweetalert::alert')
  @include('sweetalert::alert', ['cdn' => "https://cdn.jsdelivr.net/npm/sweetalert2@9"])


  <style>
    *{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}
body{
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
    background-color: rgba(218, 239, 255, 0.637);
}
.container{
    position: relative;
    display: flex;
    flex-direction: column;
    box-shadow: 20px 10px 20px 24px #d8d8d8bf;
    width: 101%;
    background-color: #cec7f334;
    border-radius: 10px;
   right: 5%;     
}
.tbodyScroll1{
  border: solid 5.4px #333;
}
.tbodyScroll1 thead tr{
  background: #333;
  color: white;
}
.tbodyScroll{
  border: solid 1px #333;
}
.overthead{
  background: #333;
  color: white;
}
.borderColor{
    border: solid 1px #333;
    background: #333;
  color: white;
}
.table_header2{
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 20px 50px 0;
    margin-bottom: 30px;

}
.table_header{
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px 30px 0;
    margin-bottom: 20px;
}
p{
  position: fixed;
  bottom: 21%;
  right: 70%;
  width: 250px;
}
 .vencimiento{
  position: fixed;
  bottom: 92%;
  right: 45%;
  width: 250px;
  font-size: 30px
}
.table_header{
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 20px 30px 0;
}
button{
    outline: none;
    border: none;
    background-color: rgb(101, 118, 218);
    color: #ede8e8;
    padding: 5px 15px;
    border-radius: 5px;
    text-transform: unset;
    font-size: 14px;
    cursor: pointer; 
}
button:hover {
    background-color: rgb(171, 189, 240);
  }
  .btn {
   font-family: 'Lato';
   font-size: inherit;
   color: inherit;
   cursor: pointer;
   display: inline-block;
   outline: none;
   position: relative;
   -webkit-transition: all 0.3s;
   -moz-transition: all 0.3s;
   transition: all 0.3s;
 }
  select{
    background-color: rgba(218, 239, 255, 0.637);
    border: none;
    border-bottom: 1px solid #c60a0a ;
    width: 200px;
    padding: 5px;
    font-size: 16px;
  }
  .input_search{
    position: relative;
  }
input{
    border-radius: 20px;
    width: 300px;
    outline: none;
    padding: 7px 15px;
    border: 1px solid #ede8e8;
    box-sizing: border-box;
    padding-right: 20px;
}
.editint{
    border-radius: 20px;
    width: 135px;
    height: 25px;
    outline: none;
    padding: 7px 20px;
    border: 3px solid #1f211e3d;
    box-sizing: border-box;
    padding-right: 20px;
    opacity: 0.9;
   
}
.CoOrig{
    position: absolute;
    top: 7%;
    right: 70%;
    border-radius: 20px;
    width: 135px;
    height: 25px;
    outline: none;
    padding: 7px 20px;
    border: 3px solid #1f211e3d;
    box-sizing: border-box;
    padding-right: 20px;
    opacity: 0.9;
}
.CoOrig1{
    position: absolute;
    top: 6.5%;
    right: 60%;
    border-radius: 20px;
    width: 111px;
    height: 30px;
    outline: none;
   
    padding-right: 20px;
    opacity: 0.9;
}

.comision{
    position: absolute;
    top: 1%;
    right: 70%;
   
    width: 135px;
    height: 25px;
    outline: none;
    padding: 7px 20px;
    box-sizing: border-box;
    padding-right: 20px;
    opacity: 0.9;
}

.search1{
    position: absolute;
    top: 20%;
    right: 0;
    transform: translate(-26%, -26%);
}
table{
    border-spacing: 4px;
    margin-top: 1rem;
    text-align: left;
    overflow: hidden;
}
thead{
    background-color: #96a526e8;  
}
th{
    padding: 10px;
    text-transform: uppercase;
    font-size: 1rem;
    font-weight: 900;
    min-width: 100px;
}
tbody{
    padding: 50px;
    text-align: center;
   
}
tr{
    padding: 4px;
    text-align: center;
    
}
.overtTr{
  position: relative;
    left: 70%;  
    padding: 4px;
    text-align: center;
    
}
td{
    padding: 5px;
    text-align: center;
    border-bottom: 3px solid #dfdfdf;
    border-right: 3px solid #dfdfdf;
    min-width: 100px;
}
.table_fotter{
    margin-top: 1rem;

}
.total{
  
  position: relative;
  left: 1%; 
  top: 50%;
  button: 20%;
}
.Calcular{
  position: absolute;
  left: 80%; 
  top: 90%;
  button: 60%;
}
.lbl{
    display: inline-block;
    width: 28px;
    height: 28px;
    background: rgb(19, 110, 94);
    border-radius: 100px;
    cursor: pointer;
    position: relative;
    transition: .2s;
}
.lbl::after{
    content: '';
    display: block;
    width: 20px;
    height: 20px;
    background: rgb(232, 241, 239);
    border-radius: 10px;
    position: absolute;
    top: 3.9px;
    left: 3.10px;
    transition: 0.2s;
}
 #swtich{
  display: flex;  
 }
 .modal{
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #111111bd;
    display: flex;
    opacity: 0;
    pointer-events: none;
    transition: opacity .5s .1s;
    --transform: translateY(-100vh);
    --transition: transform .4s;
 }
 .modal_container{
    margin: auto;
    width: 120%;
    max-width: 600px;
    max-height: 120%;
    background-color: #ffff;
    border-radius: 6px;
    padding: 4em 2.5em;
    display: grid;
    place-items: center;
    gap: 1em;
   
    grid-auto-columns: 100%;
    transform: var(--transform);
    transition: var(--transition);
 } 
.modal--show{
    opacity: 1;
    pointer-events: unset;
    transition: opacity .9s ;
    --transform: translateY(0);
    --transition: transform .6s .3s;
}
  .modal_close{
     text-decoration: none;
     color: rgb(255, 227, 227); 
     background-color: #0a81c6d7;
     padding: 1em 3em;
     border: 1px solid;
     border-radius: 6px;
     display: inline-block;
     font-weight: 300;
     transition: background-color .2s;
  }
  .modal_close:hover{
    color: #9a8989;
    background-color: rgba(227, 234, 11, 0.51);
  }
  .scroll{
    display: flex;
    background-color: #c8d9e76b;
    height: 500px;
    width: 1100px;
    overflow: scroll;
    
    border-radius: 2px;
    margin-left: 5px;
    margin-right: 5px;
  }  
  .container2{
    position: relative;
    display: flex;
    flex-direction: column;
    box-shadow: 40px 30px 80px 54px #bdbdbdbf;
    width: 46%;
    background-color: #cec7f334;
    border-radius: 10px;
    left: 1%;
}
  </style>
  <script>
document.querySelectorAll(" input").forEach(t => {t.checked = true}) 
const openModal = document.querySelector('#getmodal');
const modal = document.querySelector('.modal');
const closeModal = document.querySelector('.modal_close');

openModal.addEventListener('click', (e)=>{
  e.preventDefault();
  modal.classList.add('modal--show');
});

closeModal.addEventListener('click', (e)=>{
  e.preventDefault();
  modal.classList.remove('modal--show');
});

  </script>
</html>



