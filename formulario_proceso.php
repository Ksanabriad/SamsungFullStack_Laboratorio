<?php
if(isset($_POST['submit'])){
    $nombre=$_POST['nombre'];
    $pri_apellidos=$_POST['primer_apellido'];
    $seg_apellidos=$_POST['segundo_apellido'];
    $email=$_POST['email'];
    $login=$_POST['login'];
    $password=$_POST['password'];
    
  if(empty($nombre) || empty($pri_apellidos)||empty($seg_apellidos)||empty($email)||empty($login)||empty($password)){
        echo"<p>Todos los campos del formulario deben esta rellenos";
        exit();
    }else{
    echo"<h1>Formulario enviado correctamente</h1>";
        echo"<br>";
        echo"<h3>Los datos del usuario que desea dar de alta son: </h3>";
        echo"<p>Nombre: $nombre </p>";
        echo"<p>Primer apellidos: $pri_apellidos </p>";
        echo"<p>Segundo apellidos: $seg_apellidos </p>";
        echo"<p>Correo electrónico: $email </p>";
        echo"<p>Usuario de login: $login </p>";
        echo"<p>Contraseña: $password </p>";
    }
    echo"<br>";
    echo"<br>";
        
        
//Datos de la conexion
$servername="localhost:3308";
$username="root";
$password="";
$dbname="laboratorio";

//Crear conexion
$connection = mysqli_connect($servername, $username, $password, $dbname);
//Validar conexion
if($connection->connect_error){
    echo "No conectado";
    die("Conexion fallida en codigo de Kathe: ".$connection->connect_error);
}else{
    echo "<h1>Conectado a la base de datos llamada 'Laboratorio'</h1>";
    echo "<br>";
}


//Validar que el email no exista
$sql_email="SELECT * FROM USUARIOS WHERE EMAIL='$email'";
$result=$connection->query($sql_email);
$row_cnt=$result->num_rows;
$formulario="<a href=\"http://localhost/laboratorio/\">Formulario alta usuario</a>";

$result->close();
if($row_cnt>0){
    echo "<br>","No se ha podido dar de alta el usuario dado que el correo electrónico ".$email, " ya se encuentra registrado. Por favor, vuelva a rellenar el formulario ".$formulario;
}else{

$sql="INSERT INTO usuarios (nombre, primer_apellido, segundo_apellido, email,login, password) 
VALUES ('$nombre', '$pri_apellidos','$seg_apellidos', '$email','$login','$password')";
$consulta="SELECT nombre, primer_apellido, segundo_apellido, email, login from usuarios";
$boton_consulta="<input type='submit' name='consulta' value='Consulta'>";
if($connection->query($sql)===TRUE){
    echo "Registro completado con éxito","<br>","Si desea conocer los usuarios registrados en nuestra BBDD, pulse el botón de consulta";
    echo "<br><br>".$boton_consulta;
    
}else{
            echo "Error: ".sql."<br><br>";
            echo $connection->error;
        }
$connection->close();

}}
?>