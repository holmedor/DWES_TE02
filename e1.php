<?php declare(strict_types=1);
/*
olmedo_rodriguez_hector_DWES_TareaEvaluativa02
Ejercicio 1. - Creación del Formulario
Crea un formulario con los siguientes campos:
•	Nombre del Usuario
•	Apellido del Usuario
•	Libro Alquilado
•	Email
•	Fecha Alquiler (campo de tipo Fecha) -> Día en el que se quiere alquilar el libro. 
La fecha de devolución del libro será 10 días después de alquilarlo
•	DNI del Usuario
*/
require_once 'includes/header.php';     //cabecera de todas las páginas de la TE02
include 'includes/funciones.php';       //funciones definidas para la TE02
session_start();
//echo "usuario: ".$_SESSION['user'];
echo "Libros alquilados de la biblioteca: ";
$max=sizeof($_SESSION['biblioteca']);
for($i=0; $i<$max; $i++) { 
echo $_SESSION['biblioteca'][$i]," ";
} 
echo "<br>";
?>
    <h2>Crear nuevo alquiler de libro</h2>
<!--Aquí empieza el formulario-->
    <form action = "e2ye3.php" method = "POST" enctype = "multipart/form-data">
<!--Nombre del Usuario-->
    <label for = "nombre">Nombre del Usuario:
    <input type = "text" name = "nombre" required class = "form-control"/>
    </label>
    <br/>
<!--Apellido del Usuario-->
    <label for = "apellidos">Apellidos del Usuario:
    <input type = "text" name = "apellidos" required class = "form-control" />
    </label>
    <br/>
<!--Libro Alquilado-->
    <label for = "libro">Libro alquilado:
    <input type = "text" name= "libro" required class = "form-control" />
    </label>
    <br/>
<!--Email-->
    <label for = "email">Email:
    <input type = "email" name = "email" required class = "form-control"/>
    </label>
    <br/>
<!--Fecha Alquiler (campo de tipo Fecha) -> Día en el que se quiere alquilar el libro. 
La fecha de devolución del libro será 10 días después de alquilarlo-->
    <label for = "fecha_alquiler">Fecha Alquiler:
    <input type = "date" name = "fecha_alquiler" required class = "form-control"/>
    </label>
    <br/>
<!--DNI del Usuario-->
    <label for = "dni">DNI del Usuario:
    <input type = "dni" name = "dni" required class = "form-control"/>
    </label>
    <br/>
<!--BOTÓN "ENVIAR"-->
    <input type = "submit" value = "Enviar" name = "submit" required class = "btn btn-success" />
    </form>
<?php require_once "includes/footer.php";     //cabecera de todas las páginas de la TE02
?>