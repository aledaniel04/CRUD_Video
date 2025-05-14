<?php
include "conectar.php";

$consulta = $_POST["consultaA"];

$sql = "SELECT * FROM registro WHERE nombre LIKE '%$consulta%' OR pais LIKE '%$consulta%'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {
?>

        <tr>
            <td><?= $row["id"] ?></td>
            <td><?= $row["fecha_creacion"] ?></td>
            <td><?= $row["nombre"] ?></td>
            <td><?= $row["edad"] ?></td>
            <td><?= $row["pais"] ?></td>
            <td><?= $row["intereses"] ?></td>
            <td><?= $row["genero"] ?></td>
            <td><?= $row["correo"] ?></td>
            <td>
                <button 
                data-id="<?= $row["id"] ?>"
                data-nombre="<?= $row["nombre"] ?>"
                data-edad="<?= $row["edad"] ?>"
                data-pais="<?= $row["pais"] ?>"
                data-intereses="<?= $row["intereses"] ?>"
                data-genero="<?= $row["genero"] ?>"
                data-correo="<?= $row["correo"] ?>"
                class="btn-edit">editar</button>
                <button data-id="<?= $row["id"] ?>"
                    data-nombre="<?= $row["nombre"] ?>"
                    class="btn-delete">eliminar</button>
            </td>
        </tr>

<?php
    }
} else {
    echo "no existe ese registro";
}
$conn->close();
?>