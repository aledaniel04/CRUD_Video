<?php
include "conectar.php";


$nombre = $_POST["nombreA"];
$edad = (int) $_POST["edadA"];
$pais = $_POST["paisA"];
$intereses = implode(", ", $_POST["interesesA"]);
$genero = $_POST["generoA"];
$email = $_POST["emailA"];

$sql = "INSERT INTO registro (nombre, edad, pais, intereses, genero, correo)
VALUES ('$nombre', $edad, '$pais', '$intereses', '$genero', '$email')";

if ($conn->query($sql) === TRUE) {
  echo "nuevo registro";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>