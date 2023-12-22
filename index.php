<?php declare(strict_types=1);
// Desactivar toda notificación de error
error_reporting(0);
// Notificar solamente errores de ejecución
//error_reporting(E_ERROR | E_WARNING | E_PARSE);
/*
olmedo_rodriguez_hector_DWES_TareaEvaluativa02

Objetivo: Debes programar en PHP la parte del backend de una aplicación de registro de datos de una biblioteca. Para ello, supondremos que el usuario quiere alquilar un libro y para ello tiene que rellenar un formulario con una serie de campos. 
•	Si los datos están correctos, el sistema mostrará el nombre completo del usuario, el DNI y la fecha de devolución del libro
•	Si los datos NO son correctos, el sistema le comunicará al usuario únicamente los campos del formulario que son incorrectos.
*/
require_once 'includes/header.php';     //cabecera de todas las páginas de la TE02
session_start();
$_SESSION['biblioteca']=array();
//    array_push($_SESSION['biblioteca'],"LIBRO 1","LIBRO 2","LIBRO 3");
//$file=$_SERVER['DOCUMENT_ROOT']."/DWES_TE02/files/biblioteca.json";
$file="./files/biblioteca.json";
$size=filesize($file);
//  echo "Tamaño del fichero: ".$size."<br>";
$fp = fopen($file, "r");
if ( !$fp || $size==0 ) {
    echo "No se ha podido abrir el archivo!!!<br>";
    array_push($_SESSION['biblioteca'],"");
} else {
    $contents = fread($fp, $size);
//    echo "Contenido del fichero: ".$contents."<br>";
//    echo "<br>";   
    $arrayjson=json_decode($contents,TRUE);
    $max=sizeof($arrayjson);
//    echo "TAMAÑO: ".$max;
//    echo "<br>";   
//    echo "Contenido del fichero (DECODE): ";
    for($i=0; $i<$max; $i++) { 
//        echo $arrayjson[$i]," ";
        array_push($_SESSION['biblioteca'],$arrayjson[$i]);
    } 
//    echo "<br>";     
}
//echo "TAMAÑO: ".$max;
echo "<br>";   
if ( $max==0) {
    echo "No hay libros alquilados en la biblioteca.";
} else {
    echo "Libros alquilados de la biblioteca: ";
    for($i=0; $i<$max; $i++) { 
        echo $_SESSION['biblioteca'][$i]," ";
    }     
}
echo "<br>";    
?>
<table class="table">
    <tr>
        <th>olmedo_rodriguez_hector_DWES_TareaEvaluativa02</th>
    </tr>
    <tr>
        <td><b>Ejercicio 1. - Creación del Formulario</b>
<p>Crea un formulario con los siguientes campos:</p>
<p>•	Nombre del Usuario</p>
<p>•	Apellido del Usuario</p>
<p>•	Libro Alquilado</p>
<p>•	Email</p>
<p>•	Fecha Alquiler (campo de tipo Fecha) -> Día en el que se quiere alquilar el libro.</p> 
<p>La fecha de devolución del libro será 10 días después de alquilarlo</p>
<p>•	DNI del Usuario</p></td>
    </tr>
    <tr>
        <td><b>Ejercicio 2. - Procesado de Datos</b>
        <p>Una vez enviado el formulario, deberá chequear lo siguiente:</p>
        <p>•	El campo Email este completado y es valido.</p>
<p>•	El campo Fecha Alquiler es mayor o igual a la fecha del día en concreto.</p>
<p>•	El campo DNI es válido. Si la letra no es correcta mostrar cual sería la correcta  -> esto se realiza con el algoritmo módulo 23 explicado a continuación
<p>Para saber si el DNI es correcto, se usa el algoritmo módulo 23. El módulo 23 es el número entero obtenido como resto de la división entera del número del DNI entre 23. El resultado siempre se encontrará entre 0 y 22. Se adjunta la tabla de convalidación.</p>
<p>0   1   2   3   4   5   6   7   8   9   10  11  12  13  14  15  16  17  18  19  20  21  22</p>
<p>T   R   W   A   G   M   Y   F   P   D   X   B   N   J   Z   S   Q   V   H   L   C   K   E</p>
<p>Punto complementario para llegar al 10: Además de todo lo anterior, para llegar al 10 deberéis añadir un campo más de vuestra invención. Este campo debe tener una comprobación basada en un algoritmo. </p>
<p>•	No valdría por ejemplo un campo llamado "Dirección" y simplemente comprobar que no esté vacío. </p>
<p>•	Por ejemplo sería valido un campo referente a si el libro está alquilado o no. Este caso en concreto solo puntuará si desarrolláis un algoritmo bien implementado para ello, ya que la idea os la he dado yo.</p>
</td>
    </tr>
    <tr>
        <td><b>Ejercicio 3. - Resultado</b></p>
        <p>Una vez realizada las comprobaciones, deberás mostrar en la interfaz gráfica si los datos son correctos o no. Siempre devolveremos una página web con las correspondientes etiquetas PHP procesadas para mostrar esto.</p>
<p>•	En caso de ser correcto mostraremos los datos:</p>
<p>o	Nombre de Usuario</p>
<p>o	Fecha de devolución (10 días más de la fecha de alquiler)</p>
<p>o	DNI </p>
<p>•	En caso contrario mostraremos por pantalla qué campos no se han introducido correctamente. En el caso del DNI mostraremos la letra que sería correcta</p>
</td>
    </tr>
</table>
<?php require_once "includes/footer.php";     //cabecera de todas las páginas de la TE02
?>