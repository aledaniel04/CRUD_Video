<?php
session_start();
include "conectar.php";

$username = trim($_POST["usuarioA"]);
$password = trim($_POST["passwordA"]);

$sql = "SELECT id, username, password FROM usuario WHERE username = '$username' OR email = '$username'";

$result = $conn->query($sql);

if ($result->num_rows == 1) {
   $row = $result->fetch_assoc();
   if (password_verify($password, $row["password"])) {
    $_SESSION["usuario_id"] = $row["id"];
    $_SESSION["username"] = $row["username"];
    echo"iniciaste sesion";
   }else{
    echo"contraseña incorrecta";
   }
}else{
    echo"el usuario no existe";
}

$conn->close();