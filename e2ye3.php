<?php declare(strict_types=1);
/*
olmedo_rodriguez_hector_DWES_TareaEvaluativa02

Ejercicio 2. - Procesado de Datos
Una vez enviado el formulario, deberá chequear lo siguiente:
•	El campo Email este completado y es valido.
•	El campo Fecha Alquiler es mayor o igual a la fecha del día en concreto.
•	El campo DNI es válido. Si la letra no es correcta mostrar cual sería la correcta  -> 
esto se realiza con el algoritmo módulo 23 explicado a continuación
Para saber si el DNI es correcto, se usa el algoritmo módulo 23. 
El módulo 23 es el número entero obtenido como resto de la 
división entera del número del DNI entre 23. 
El resultado siempre se encontrará entre 0 y 22. Se adjunta la tabla de convalidación.

0   1   2   3   4   5   6   7   8   9   10  11  12  13  14  15  16  17  18  19  20  21  22
T   R   W   A   G   M   Y   F   P   D   X   B   N   J   Z   S   Q   V   H   L   C   K   E

Punto complementario para llegar al 10: Además de todo lo anterior, 
para llegar al 10 deberéis añadir un campo más de vuestra invención. 
Este campo debe tener una comprobación basada en un algoritmo. 
•	No valdría por ejemplo un campo llamado "Dirección" y simplemente comprobar que no esté vacío. 
•	Por ejemplo sería valido un campo referente a si el libro está alquilado o no. 
Este caso en concreto solo puntuará si desarrolláis un algoritmo bien implementado para ello, ya que la idea os la he dado yo.
*/
require_once 'includes/header.php';     //cabecera de todas las páginas de la TE02
include 'includes/funciones.php';       //funciones definidas para la TE02
$errors=array();                        //variable donde se guardarán los errores tras evaluar el formulario
$errors["nombre"]="";                   //errores correspondientes al campo nombre
$errors["apellidos"]="";                //errores correspondientes al campo apellidos
$errors["libro"]="";                    //errores correspondientes al campo libro
$errors["email"]="";                    //errores correspondientes al campo email
$errors["fecha_alquiler"]="";           //errores correspondientes al campo fecha_alquiler 
$errors["dni"]="";                      //errores correspondientes al campo dni
session_start();
echo "<br>";
if(isset($_POST["submit"])){
    if ( !empty( $_POST[ "nombre" ] ) && strlen( $_POST[ "nombre" ] ) <= 20 &&
        !is_numeric( $_POST[ "nombre" ] ) && !preg_match( "/[0-9]/", $_POST[ "nombre" ] ) ) {
    } else {
        $errors[ "nombre" ] = "Nombre de Usuario: ".$_POST[ "nombre" ]." no es válido. <b>Introduce un nombre válido.</b><br/>";
    }
    if ( !empty( $_POST[ "apellidos" ] ) && strlen( $_POST[ "apellidos" ] ) <= 20 &&
        !is_numeric( $_POST[ "apellidos" ] ) && !preg_match( "/[0-9]/", $_POST[ "apellidos" ] ) ) {
    } else {
        $errors[ "apellidos" ] = "Apellidos del Usuario: ".$_POST[ "apellidos" ]." no es válido. <b>Introduce unos apellidos válidos.</b><br/>";
    }
    if ( !empty( $_POST[ "libro" ] && strlen( $_POST[ "libro" ] ) <= 20 ) && librook($_SESSION['biblioteca'],$_POST[ "libro" ])) {
    } else {
        if (!librook($_SESSION['biblioteca'],$_POST[ "libro" ])) {
            $errors[ "libro" ] = "El libro: ".$_POST[ "libro" ]." está alquilado. <b>Introduce un título de libro válido.</b><br/>";
        } else {
            $errors[ "libro" ] = "Título del libro: ".$_POST[ "libro" ]." no es válido. <b>Introduce un título de libro válido.</b><br/>";
        }
    }
    if ( !empty( $_POST[ "email" ] ) && filter_var( $_POST[ "email" ], FILTER_VALIDATE_EMAIL ) ) {
    } else {
        $errors[ "email" ] = "Email del Usuario: ".$_POST[ "email" ]." no es válido. <b>Introduce un email válido.</b><br/>";
    }       
    if ( !empty( $_POST[ "fecha_alquiler" ] ) && fechaok( $_POST[ "fecha_alquiler" ])
    )  {
    } else {
        $errors[ "fecha_alquiler" ] = "Fecha de alquiler del libro: ".$_POST[ "fecha_alquiler" ]." <b>Introduce una fecha de alquiler válida.</b><br/>";
    }       
    if ( !empty( $_POST[ "dni" ] ) && dniOK($_POST[ "dni" ])=="OK" ) {
    } else {
        if ($_POST[ "dni" ]==""){
            $errors[ "dni" ] = "DNI del Usuario: ".$_POST[ "dni" ]." vacío. <b>Introduce un DNI válido.</b> <br/>";
        } else {
            $errors[ "dni" ] = "DNI del Usuario: ".$_POST[ "dni" ]." no es válido. Su letra sería: ".dniOK($_POST[ "dni" ]).". <b>Introduce un DNI válido.</b> <br/>";
        }
    }                
}
/*
olmedo_rodriguez_hector_DWES_TareaEvaluativa02

Ejercicio 3. - Resultado
Una vez realizada las comprobaciones, deberás mostrar en la interfaz gráfica si los datos son correctos o no. 
Siempre devolveremos una página web con las correspondientes etiquetas PHP procesadas para mostrar esto.
•	En caso de ser correcto mostraremos los datos:
o	Nombre de Usuario
o	Fecha de devolución (10 días más de la fecha de alquiler)
o	DNI 
•	En caso contrario mostraremos por pantalla qué campos no se han introducido correctamente. En el caso del DNI mostraremos la letra que sería correcta
*/
if($errors["nombre"]=="" && $errors["apellidos"]=="" && $errors["libro"]=="" && $errors["email"]=="" && $errors["fecha_alquiler"]=="" && $errors["dni"]==""){
    echo "Nombre y Apellidos del Usuario: ".$_POST[ "nombre" ]." ".$_POST[ "apellidos" ].".<br/>";        
    echo "DNI del Usuario: ".$_POST[ "dni" ].".<br/>";
    echo "Fecha de hoy: ".date("d/m/Y").".<br/>";
    echo "Fecha de alquiler del libro: ".date("d/m/Y", strtotime($_POST[ "fecha_alquiler" ]))."."."<br/>"; 
    echo "La fecha de devolución es ".fecha_devol($_POST[ "fecha_alquiler" ]).".<br/>";
    array_push($_SESSION['biblioteca'],$_POST[ "libro" ]);
} else {
    echo $errors["nombre"];
    echo $errors["apellidos"];
    echo $errors["libro"];
    echo $errors["email"];
    echo $errors["fecha_alquiler"];
    echo $errors["dni"];
}
echo "Libros alquilados de la biblioteca: ";
$max=sizeof($_SESSION['biblioteca']);
for($i=0; $i<$max; $i++) { 
    echo $_SESSION['biblioteca'][$i]," ";
}
echo "<br>";
$arrayjson=array();
$arrayjson=$_SESSION['biblioteca']; 
//echo "Libros alquilados de la biblioteca (arrayjson json_encode): ";
$arrayjson=json_encode($arrayjson, JSON_PRETTY_PRINT);
//echo $arrayjson;
$file=$_SERVER['DOCUMENT_ROOT']."/DWES02TEjson/files/biblioteca.json";
$fp = fopen($file, "w");
fwrite($fp, $arrayjson);
fclose($fp);
?>
<?php require_once "includes/footer.php";     //cabecera de todas las páginas de la TE02
?>