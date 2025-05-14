<?php
session_start();
if (!isset($_SESSION["usuario_id"])) {
    header("location: login.html");
    exit;
}
?> 

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>mi CRUD</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
</head>

<body>

<h1>bienvenido <?= $_SESSION["username"]?></h1>

    <div class="d-flex">
        <button id="agregar" class="w-25 bg-primary m-3 p-2 fs-3 fw-bold">Agregar</button>
    
        <label class="fs-3 fw-bold" for="buscar">buscar</label>
        <input id="busqueda" class="w-25 m-3 p-2 fs-3 fw-bold" type="text">
    
        <button id="salir">cerrar sesión</button>
    </div>



    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>id</th>
                    <th>fecha</th>
                    <th>nombre</th>
                    <th>edad</th>
                    <th>pais</th>
                    <th>intereses</th>
                    <th>genero</th>
                    <th>correo</th>
                    <th>opciones</th>
                </tr>
            </thead>
            <tbody id="mostra_registros">

            </tbody>
        </table>
    </div>

    <div id="cerrar_sesion" class="popup_padre">
        <div class="cerrar_sesion_hijo">
            <h1>¿estas seguro de cerrar sesion?</h1>
            <div class="button_cerrar_sesion">
                <button id="logout">cerrar sesion</button>
                <button id="retroceder">cancelar</button>
            </div>
        </div>
    </div>

    <div id="popup_eliminar" class="popup_padre">
        <div class="eliminar_hijo">
            <h1>¿estas seguro de eliminar a <b id="nombre_eliminar"></b> ?</h1>
            <div class="button_eliminar">
                <button id="eliminar">eliminar</button>
                <button id="cancelar">cancelar</button>
            </div>
        </div>
    </div>

    <div id="popup_agregar" class="popup_padre">
        <form id="formulario" class="form-container">
            <h1 id="titulo"></h1>
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" placeholder="Escribe tu nombre" required>
            </div>
            <div class="form-group">
                <label for="edad">Edad:</label>
                <input type="number" id="edad" name="edad" min="0" placeholder="0" required>
            </div>
            <div class="form-group">
                <label for="pais">País:</label>
                <select id="pais" name="pais" required>
                    <option value="" disabled selected>-- Selecciona un país --</option>
                    <option value="colombia">Colombia</option>
                    <option value="mexico">México</option>
                    <option value="espana">España</option>
                </select>
            </div>
            <div class="form-group">
                <label>Intereses:</label>
                <div class="checkbox-group">
                    <label>
                        <input class="intereses" type="checkbox" name="intereses" value="musica" required>
                        Música
                    </label>
                    <label>
                        <input class="intereses" type="checkbox" name="intereses" value="deportes">
                        Deportes
                    </label>
                    <label>
                        <input class="intereses" type="checkbox" name="intereses" value="lectura">
                        Lectura
                    </label>
                    <label>
                        <input class="intereses" type="checkbox" name="intereses" value="cine">
                        Cine
                    </label>
                    <label>
                        <input class="intereses" type="checkbox" name="intereses" value="tecnologia">
                        Tecnología
                    </label>
                </div>
            </div>
            <label for="">Genero:</label>
            <div class="form-group radio-group">
                <label>
                    <input class="genero" type="radio" name="genero" value="masculino" required>
                    Masculino
                </label>
                <label>
                    <input class="genero" type="radio" name="genero" value="femenino" required>
                    Femenino
                </label>
                <label>
                    <input class="genero" type="radio" name="genero" value="otro" required>
                    Otro
                </label>
            </div>
            <div class="form-group">
                <label for="email">Correo electrónico:</label>
                <input type="email" id="email" name="email" placeholder="tu@correo.com" required>
            </div>
            <div class="button-group">
                <button type="submit">Guardar</button>
                <button id="regresar" class="boton_regresar">regresar</button>
            </div>
        </form>
    </div>

    <script src="main.js"></script>
</body>

</html>