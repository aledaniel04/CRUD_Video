<?php

include "conectar.php";

$username= trim($_POST["usuarioA"]);
$email = trim($_POST["correoA"]);
$password = trim($_POST["contrasenaA"]);

$sql_verificar_usuario= "SELECT * FROM usuario WHERE username = '$username'";
$result_usuario = $conn->query($sql_verificar_usuario);
if ($result_usuario->num_rows > 0) {
    die("el usuario ya existe");
}

$sql_verificar_email= "SELECT * FROM usuario WHERE email = '$email'";

$result_email = $conn->query($sql_verificar_email);

if ($result_email->num_rows > 0) {
    die("el email ya existe");
}

$hashed_password = password_hash($password, PASSWORD_DEFAULT);

$sql = "INSERT INTO usuario (username, email, password)
VALUES ('$username', '$email', '$hashed_password')";

if ($conn->query($sql) === TRUE) {
  echo "nuevo usuario";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();