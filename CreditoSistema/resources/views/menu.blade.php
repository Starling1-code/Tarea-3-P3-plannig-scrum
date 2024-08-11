<style>
.menu-container {
    position: relative; /* Establece la posición relativa */
  left: 0%; /* Mueve el contenedor hacia la mitad del ancho de la página */
  top: -5%;
  transform: translateX(-100%); /* Centra el contenedor horizontalmente */

}

.menu {
  background-color: #bcc5d422;
  width: 100px;
}

.menu ul {
  list-style: none;
  padding: 0;
  margin: 0;
}

.menu li {
  border: 1px solid #ddd;
  border-radius: 5px;
  margin-bottom: 10px;
}


.menu a {
  display: block;
  padding: 10px;
  color: #333;
  text-decoration: none;
}

.menu a:hover {
  background-color: #ddd;
}



</style>
<div class="menu-container">
    <div class="menu">
      <ul>
        <li><a href="{{route('credito.index')}}">Inicio</a></li>
        <li><a href=" {{route('Actualizar.Comision')}}">Seguro</a></li>
        <li><a href=" {{route('ActualizarF.Frecuencia')}}">Frecuencia</a></li>
      </ul>
    </div>
  </div>
  
