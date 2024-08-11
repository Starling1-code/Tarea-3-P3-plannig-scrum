

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
        <h2>Agregar Seguro</h2> 
        @php 
        $FechaActual = today();
        @endphp
       <button  id="getmodal">Agregar Seguro</button>
      <div class="input_search">
        <form action="{{route('Comision.filtros')}}" method="GET">
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
              <th>Frecuencia</th>
            

           </tr>
        </thead>
      <tbody>   
        @php
       
          @endphp
          
          <form action=" {{route('credito.UpdatePlanPago')}}" method="get">
        @foreach($Creditos as $l)
     
          <tr>
          @php
          @endphp
            <td>
                
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
            <td>{{$l->cod_frecuencia_pago_Cuota}}</td> 
            </tr>
            
          @endforeach
          
          </form>
         
        </tbody>
      </table>
    </section>
    </div>
    <div class="table_fotter d-flex justify-content-center">       
     
      <a href="{{route('credito.index')}}"> <button type="submit" class="btnVolver">Volver</button> </a>
    
      </div>

        
      </div>
      </div>
  </div>
  <section class="modal ">
    <div class="modal_container">
      
      <div class="NoCredito">
      <label for="">No.Credito</label>
      <input type="number"  value="{{$l->no_credito}}" disabled>
      </div>

      <div class="nombre">
      <label for="">Nombre</label>
      <input type="text"  value="{{$l->nombres}}" disabled>
      </div>

      <div class="seguro">
      <label for="">Seguro</label>
      <input type="number"  value="{{$l->comision}}" disabled>
      </div>

      <label class="CuotaActual" for="">Monto Cuota Actual</label>
          <div class="cuota">
          <label class="montos" for="">Cuota</label>
          <input type="number" id="cuota" value="{{$l->cuota}}" disabled>
          </div>

          <div class="capital">
              <label  class="montos" for="">Capital</label>
              <input type="number"  value="{{$l->capital}}" id="capital" disabled>
              </div>

              <div class="interes">
              <label  class="montos" for="">Interes</label>
              <input type="number"  value="{{$l->INTERES}}" id="interes" disabled>
              </div>

              <form action="{{route('credito.UpdatePlanPagoC')}}" method="get">

                <div class="seguromonto">
                    <label  class="montos2" for="">Seguro</label>
                    <input type="hidden" name="nocredito" value="{{$l->no_credito}}" >
                    <input type="number" step="0.01" class="seguro1" name="seguro" value="" id="seguro" required>
                    </div>


                    <label class="CuotaActual1" for="">Monto Cuota Nueva</label>
                    <div class="cuota1">
                      <label class="montos1" for="">Cuota</label>
                     
                      <input type="number" step="0.01" name="cuota"  value="{{$l->capital + $l->INTERES}}"  id="cuotaresult" required>  
               </div>
               <button type="submit" class="aplicar">Aplicar</button>
              </form>
            
          <div class="capital1">
              <label  class="montos" for="">Capital</label>
              <input type="number"  value="{{$l->capital}}" disabled>
              </div>
              
              <div class="interes1">
              <label  class="montos" for="">Interes</label>
              <input type="number"  value="{{$l->INTERES}}" disabled>
              </div>

              <div class="seguromonto1">
                  <label  class="montos" for="">Seguro</label>
                  <input type="number" id="seguroresult" disabled>
                  </div>
                  <div class="action">
                  
                  <a type="button" class="clear" id="clear">Limpiar</a>
                  <a type="button" class="modal_close">Cerrar</a>
              </div>
            
          
     
      
    </div> 
  </section>

    



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
  .NoCredito{
    position: relative;
    display: flex;
    left: 0%;
    top: 100%;
   
  }

  .nombre{
    position: relative;
    display: flex;
    right: 20%;
    left: 80%;
    top: -40%;
  }
  .seguro{
    position: relative;
    display: flex;
    left: 157%;
    top: -185%;
  }
  .cuota{
    position: relative;
    display: flex;
    left: 40%;
    top: -45%;
  }
  .capital{
    position: relative;
    display: flex;
    left: 85%;
    top: -185%;
  }

  .interes{
    position: relative;
    display: flex;
    left: 133%;
    top: -330%;
  }
  .seguromonto{
    position: relative;
    display: flex;
    left: 180%;
    top: -180%;
  }
  .CuotaActual{
    position: relative;
    display: flex;
    left: 5%;
    top: 95%;
  }
 
  label.montos{
    position: relative;
    display: flex;
    left: 30%;
    top: -90%;

}

.cuota1{
    position: relative;
    display: flex;
    left: 40%;
    top: -76.5%;
  }

  .interes1{
    position: relative;
    display: flex;
    left: 133%;
    top: -645%;
  }
  .capital1{
    position: relative;
    display: flex;
    left: 85%;
    top: -500%;
  }
  .seguromonto1{
    position: relative;
    display: flex;
    left: 180%;
    top: -790%;
  }

  .CuotaActual1{
    position: relative;
    display: flex;
    left: 5%;
    top: -55%;
  }
 
  label.montos1{
    position: relative;
    display: flex;
    left: 30%;
    top: -25px;

}
label.montos2{
    position: relative;
    display: flex;
    left: 29%;
    top: 30px;
}
input.seguro1{
  position: relative;
    display: flex;
    left: 3.5%;
    top: 54.5px;
}
.action{
    position: relative;
    display: flex;
    left: 200%;
    top: -900%;
}

.clear{
    position: relative;
     display: flex;
     left: -58%;
     top: 210%;
     text-decoration: none;
     color: rgb(255, 227, 227); 
     background-color: #b3c60ad7;
     padding: 0.2em 2em;
     border: 1px solid;
     border-radius: 6px;
     
     font-weight: 100;
     transition: background-color .2s;
}

.aplicar{
    position: relative;
     display: flex;
     left: 108.5%;
     top: -20%;
     text-decoration: none;
     color: rgb(250, 239, 239); 
     background-color: #0a81c6d7;
     padding: 0.3em 2.5em;
     border: 1.1px solid;
     border-radius: 6px;
     display: inline-block;
     font-weight: 100;
     transition: background-color .2s;
}
 
input{
    position: relative;
    left: 2%;
    top: -15%;
    border-radius: 10px;
    width: 150px;
    outline: none;
    padding: 4px 10px;
    border: 1px solid #ede8e8;
    box-sizing: border-box;
    padding-right: 1px;
 
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
    position: relative;
    left: 110px;
    margin: 100px;
    width: 1000%;
    max-width: 1000px;
    background-color: #ffff;
    border-radius: 6px;
    padding: 3em 2.5em;
    display: grid;
    gap: 1em;
    grid-auto-columns: 40%;
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
    position: relative;
     display: flex;
     left: -56%;
     top: 210%;
     text-decoration: none;
     color: rgb(250, 239, 239); 
     background-color: #0a81c6d7;
     padding: 0.2em 2em;
     border: 1px solid;
     border-radius: 6px;
     display: inline-block;
     font-weight: 100;
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
const seguro = document.getElementById("seguro");
const CuotaActual = document.getElementById("cuota");
const capital = document.getElementById("capital");
const interes = document.getElementById("interes");
const cuotaresult = document.getElementById("cuotaresult");
const seguroresult = document.getElementById("seguroresult");
const btnClear = document.getElementById("clear");


btnClear.addEventListener('click', function(){
    document.getElementById("cuotaresult").value = "";
    document.getElementById("seguroresult").value = "";
    document.getElementById("seguro").value = "";
});

function calcular(){

    
    const valor1 = parseFloat(seguro.value);
    const valor2 = parseFloat(CuotaActual.value);
    
    const suma = valor1 + parseFloat(capital.value) + parseFloat(interes.value);

    cuotaresult.textContent = suma;
    document.getElementById("cuotaresult").value = suma;
    document.getElementById("seguroresult").value = seguro.value;

    
    
}


seguro.addEventListener("input", calcular);



document.querySelectorAll("input").forEach(t => {t.checked = true}) 
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



