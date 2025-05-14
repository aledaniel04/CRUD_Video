$(document).ready(function () {
    $("#popup_agregar").hide();
    $("#popup_eliminar").hide();
    $("#cerrar_sesion").hide();

    //registrar un nuevo usuario
    $("#formRegistro").submit(function (e) {
        e.preventDefault();
        let usuario = $("#username").val();
        let correo = $("#email").val();
        let contrasena = $("#password").val();
        let confirmar_contrasena = $("#confirm_password").val();

        if (contrasena !== confirmar_contrasena) {
           return $("#mensaje").text("las contraseñas no coinciden");
        }

        $.ajax({
            type: "POST",
            url: "registrarse.php",
            data: {
                usuarioA: usuario,
                correoA: correo,
                contrasenaA: contrasena
            },
            success: function (response) {
                if (response === "nuevo usuario") {
                   return window.location.href = "login.html";
                }
                $("#mensaje").text(response);
            }
        });
    });

    //iniciar sesion
    $("#formLogin").submit(function (e) {
        e.preventDefault();
        let usuario = $("#username").val();
        let contrasena = $("#password").val();

        $.ajax({
            type: "POST",
            url: "login.php",
            data: {
                usuarioA: usuario,
                passwordA: contrasena
            },
            success: function (response) {
                console.log(response)
                if (response === "iniciaste sesion") {
                    window.location.href = "index.php";
                } else {
                    $("#mensaje").text(response);
                }
            }
        });
    });

    //cerrar sesion
    $("#salir").click(function (e) {
        e.preventDefault();
        $("#cerrar_sesion").show();

        $("#retroceder").click(function (e) {
            e.preventDefault();
            $("#cerrar_sesion").hide();
        });
        $("#logout").click(function (e) {
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: "logout.php",
                success: function () {
                    window.location.href = "login.html";
                }
            });
        });


    });

    let modo = 'crear';
    let idEditar = null;

    $("#agregar").click(function (e) {
        e.preventDefault();
        $("#popup_agregar").show();
        modo = 'crear';
        $("#titulo").text("agregar un registro");
    });

    $("#regresar").click(function (e) {
        e.preventDefault();
        $("#popup_agregar").hide();
        $("#formulario")[0].reset();
        modo = 'crear';
    });

    $("#mostra_registros").on("click", ".btn-edit", function () {
        modo = 'editar';
        idEditar = $(this).data("id");
        $("#popup_agregar").show();
        $("#titulo").text("editar un registro");

        let nombre = $(this).data("nombre");
        let edad = $(this).data("edad");
        let pais = $(this).data("pais");
        let intereses = $(this).data("intereses");
        let genero = $(this).data("genero");
        let correo = $(this).data("correo");

        $("#nombre").val(nombre);
        $("#edad").val(edad);
        $("#pais").val(pais);
        $("#email").val(correo);

        let interesesArray = intereses.split(",").map(item => item.trim())

        $(".intereses").each(function () {
            if (interesesArray.includes($(this).val())) {
                $(this).prop("checked", true)
            } else {
                $(this).prop("checked", false)
            }
        })

        $(".genero").each(function () {
            if ($(this).val() === genero) {
                $(this).prop("checked", true)
            } else {
                $(this).prop("checked", false)
            }
        })


    })


    //insertar y editar un nuevo registro
    $("#formulario").submit(function (e) {
        e.preventDefault();

        let nombre = $("#nombre").val();
        let edad = $("#edad").val();
        let pais = $("#pais").val();
        let intereses = [];
        $(".intereses:checked").each(function () {
            intereses.push(this.value)
        })
        let genero = $(".genero:checked").val();
        let email = $("#email").val();

        let url = (modo === 'editar') ? 'editar.php' : 'insertar.php';

        let data = {
            nombreA: nombre,
            edadA: edad,
            paisA: pais,
            interesesA: intereses,
            generoA: genero,
            emailA: email
        }

        if (modo === 'editar') {
            data.id = idEditar
        }

        $.ajax({
            type: "POST",
            url: url,
            data: data,
            success: function (response) {
                $("#popup_agregar").hide();
                $("#formulario")[0].reset();
                mostrar();
                modo = 'crear';
                idEditar = null;
                alert(response)
            },
            error: function (error) {
                alert("se produjo un error" + error)
            }
        });
    });

    //mostrar registros de la base de datos

    function mostrar() {
        $.ajax({
            type: "POST",
            url: "mostrar.php",
            success: function (response) {
                $("#mostra_registros").html(response)
            }
        });
    }

    mostrar()

    // eliminar un registro de la base de datos
    $("#mostra_registros").on("click", ".btn-delete", function () {
        $("#popup_eliminar").show();

        let id = $(this).data("id")
        let nombre = $(this).data("nombre")

        $("#nombre_eliminar").text(nombre);

        $("#eliminar").click(function (e) {
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: "eliminar.php",
                data: {
                    idA: id
                },
                success: function () {
                    $("#popup_eliminar").hide();
                    mostrar()
                }
            });
        });

        $("#cancelar").click(function (e) {
            e.preventDefault();
            $("#popup_eliminar").hide();
        });
    })


    //buscar un registro en la tabla

    function buscar(consulta) {
        $.ajax({
            type: "POST",
            url: "buscar.php",
            data: { consultaA: consulta },
            success: function (response) {
                $("#mostra_registros").html(response)
            }
        });
    }

    $(document).on("keyup", "#busqueda", function () {
        let buscando = $(this).val()
        console.log(buscando)

        if (buscando != "") {
            buscar(buscando)
        } else {
            mostrar()
        }
    })

});