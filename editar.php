<?php
include "conectar.php";

$id= $_POST["id"];
$nombre = $_POST["nombreA"];
$edad = (int) $_POST["edadA"];
$pais = $_POST["paisA"];
$intereses = implode(", ", $_POST["interesesA"]);
$genero = $_POST["generoA"];
$email = $_POST["emailA"];

$sql = "UPDATE registro SET nombre='$nombre', edad=$edad, pais='$pais', intereses='$intereses', genero='$genero', correo='$email' WHERE id=$id";

if ($conn->query($sql) === TRUE) {
  echo "tu registro se actualizo con exito";
} else {
  echo "Error updating record: " . $conn->error;
}

$conn->close();
?>