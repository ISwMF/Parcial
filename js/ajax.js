function verTodoslosBienes() {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("demo").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "http://localhost/Parcial/Servidor/Controller.php?bienesver=true", true);
  xhttp.send();
}
function verTodoelInventario() {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("demo").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "http://localhost/Parcial/Servidor/Controller.php?inventariover=true", true);
  xhttp.send();
}
function verTodosLosProveedores() {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("demo").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "http://localhost/Parcial/Servidor/Controller.php?proveedoresver=true", true);
  xhttp.send();
}
function verBienesparaElimiar(){
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("demo").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "http://localhost/Parcial/Servidor/Controller.php?delbienver=true", true);
  xhttp.send();
}
function verInventarioparaEliminar(){
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("demo").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "http://localhost/Parcial/Servidor/Controller.php?delinvver=true", true);
  xhttp.send();
}
function verProveedorparaEliminar(){
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("demo").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "http://localhost/Parcial/Servidor/Controller.php?delprovver=true", true);
  xhttp.send();
}
