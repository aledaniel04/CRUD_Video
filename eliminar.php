<?php
include"conectar.php";

$indice = $_POST["idA"];

// sql to delete a record
$sql = "DELETE FROM registro WHERE id=$indice";

if ($conn->query($sql) === TRUE) {
  echo "registro eliminado";
} else {
  echo "Error deleting record: " . $conn->error;
}

$conn->close();
?>