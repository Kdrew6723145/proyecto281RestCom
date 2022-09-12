<?php
$alert = '';
session_start();
if (!empty($_SESSION['active'])) {
    header('location: sistema_rest/');
} else {
    if (!empty($_POST)) {
        if (empty($_POST['usuario']) || empty($_POST['clave'])) {
            $alert = "Ingrese su usuario y contraseña";
        } else {
            require_once "./include/conexion.php";
            $user = mysqli_real_escape_string($conn, $_POST['usuario']);
            $pass = mysqli_real_escape_string($conn, $_POST['clave']);

            $query1 = mysqli_query($conn, "SELECT * FROM usuario WHERE nick='$user' and clave='$pass'");
            $result1 = mysqli_num_rows($query1);

            $query2 = mysqli_query($conn, "SELECT * FROM administrador WHERE nick='$user' and clave='$pass'");
            $result2 = mysqli_num_rows($query2);



            if ($result1 > 0) {
                $data = mysqli_fetch_array($query1);

                $_SESSION['activeU'] = true;
                $_SESSION['idUsuario'] = $data['id_usuario'];
                $_SESSION['nombre_u'] = $data['nombres'];
                $_SESSION['ap_paterno_u'] = $data['apPat'];
                $_SESSION['ap_materno_u'] = $data['apMat'];
                $_SESSION['nombreUsuario'] = $data['nick'];
                $_SESSION['clave_u'] = $data['clave'];
                $_SESSION['nacionalidad_u'] = $data['nacionalidad'];
                $_SESSION['correo_u'] = $data['email'];
                $_SESSION['rol'] = $data['rol'];
                $_SESSION['id_admin_u'] = $data['id_admin'];

                print_r($_SESSION);
                header('Location: sistema_rest/vista_usuario.php');
                //header('Location: sistema_rest/vista_usuario.php');

                /*if ($_SESSION['rol'] == 'CLIENTE') {
                    header('Location: sistema_rest/vista_cliente.php');
                }else{
                    if ($_SESSION['rol']=='CAJERO' || $_SESSION['rol']=='MESERO' || $_SESSION['rol']=='CHEF'){
                        
                    }
                }
                */
            } else {
                if ($result2 > 0) {

                    $data = mysqli_fetch_array($query2);

                    $_SESSION['activeA'] = true;
                    $_SESSION['idAdmin'] = $data['id_admin'];
                    $_SESSION['NombreA'] = $data['nombre'];
                    $_SESSION['ap_paterno'] = $data['apPat'];
                    $_SESSION['ap_materno'] = $data['apMat'];
                    $_SESSION['nombreUAdmin'] = $data['nick'];
                    $_SESSION['clave'] = $data['clave'];
                    $_SESSION['experiencia'] = $data['an_expe'];
                    $_SESSION['salarioAd'] = $data['salario'];
                    $_SESSION['rol_admin'] = "ADMIN";

                    header('Location:sistema_rest/vista_admin.php');
                } else {
                    $alert = "Usuario y Clave incorrectos";
                    session_destroy();
                }
            }
        }
    }
}

?>

<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login </title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="assets/css/tailwind.output.css" />
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <script src="assets/js/init-alpine.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</head>

<body>
    <div class="flex items-center min-h-screen p-6 bg-gray-50 dark:bg-gray-900">
        <div class="flex-1 h-full max-w-4xl mx-auto overflow-hidden bg-white rounded-lg shadow-xl dark:bg-gray-800">
            <div class="flex flex-col overflow-y-auto md:flex-row">
                <div class="h-32 md:h-auto md:w-1/2">
                    <img aria-hidden="true" class="object-cover w-full h-full dark:hidden" src="assets/img/imagen_login.png" alt="Office" />

                </div>

                <div class="flex items-center justify-center p-6 sm:p-12 md:w-1/2">
                    <form action="" method="post">
                        <div class="w-full">

                            <img aria-hidden="true" class="object-cover w-full h-full dark:hidden" src="assets/img/logo.png" alt="Office" />
                            <label class="block text-sm">
                                <span class="text-gray-700 dark:text-gray-400">Usuario</span>
                                <input class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-orange-400 focus:outline-none focus:shadow-outline-orange dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="Codigo Usuario" type="text" name="usuario" id="cod_usr" />
                            </label>
                            <label class="block mt-4 text-sm">
                                <span class="text-gray-700 dark:text-gray-400">Contraseña</span>
                                <input class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-orange-400 focus:outline-none focus:shadow-outline-orange dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="***************" type="password" name="clave" id="pwd" />
                            </label>
                            <input type="submit" value="INGRESAR" class="block w-full px-4 py-2 mt-4 text-sm font-medium leading-5 text-center text-white transition-colors duration-150 bg-red-600 border border-transparent rounded-lg active:bg-orange-600 hover:bg-red-700 focus:outline-none focus:shadow-outline-red">

                            <hr class="my-8" />

                            <p class="mt-4">
                                <a class="text-sm font-medium text-gray-600 dark:text-black-400 hover:underline" href="./forgot-password.html">
                                    ¿Olvidaste tu contraseña?
                                </a>
                            </p>

                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</body>

</html>
