<?php

namespace controllers;

use Clases\Email;
use Model\Usuario;
use MVC\Router;

class LoginController
{
    public static function login(Router $router)
    {
        $alertas = [];


        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $auth = new Usuario($_POST);
            $alertas =  $auth->validarLogin();

            if (empty($alertas)) {
                //comprobar que exita el ususario

                $usuario = Usuario::where('email', $auth->email);


                if ($usuario) {

                    //verifica el password

                    if ($usuario->comprobarPasswordVerificado($auth->password)) {
                        //autenticar al usuario

                        if (!isset($_SESSION)) {
                            session_start();
                        };

                        $_SESSION['id'] = $usuario->id;
                        $nombreCompleto =   $_SESSION['nombre'] = $usuario->nombre . " " . $usuario->apellido;
                        $_SESSION['email'] = $usuario->email;
                        $_SESSION['login'] = true;


                        //redireccionamiento
                        if ($usuario->admin === "1") {

                            $_SESSION["admin"] = isset($usuario->admin) ? $usuario->admin : null;


                            header('Location: /admin');
                            echo 'bienvenido', $nombreCompleto;
                        } else {
                            header('Location: /cita');
                        }
                    }
                } else {
                    Usuario::getAlertas('error', 'usuario no encontrado');
                }
            }
        }
        $alertas = Usuario::getAlertas();


        $router->render('auth/login', [
            'alertas' => $alertas
        ]);
    }

    public static function logout()
    {
        session_start();

        $_SESSION = [];

        header('Location:/');
    }
    public static function olvide(Router $router)
    {
        $alertas = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $auth = new Usuario($_POST);
            $alertas =    $auth->validarEmail();


            if (empty($alertas)) {

                $usuario = Usuario::where('email', $auth->email);

                if ($usuario && $usuario->confirmado === "1") {
                    //generar token

                    $usuario->crearToken();
                    $usuario->guardar();

                    //ENVIAR EL EMAIL

                    $email = new Email($usuario->email, $usuario->nombre, $usuario->token);
                    $email->enviarInstrucciones();

                    //alerta de exito
                    Usuario::setAlerta('exito', 'revisa tu email');
                } else {
                    Usuario::setAlerta('error', 'el usuario no existe o no esta confirmado');
                }
            }
        }
        $alertas = Usuario::getAlertas();
        $router->render('auth/olvide-password', [
            'alertas' => $alertas
        ]);
    }
    public static function crear(Router $router)
    {

        $usuario = new Usuario;
        $alertas = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario->sincronizar($_POST);
            $alertas = $usuario->validarNuevaCuenta();


            // revisar que alertas este vacio

            if (empty($alertas)) {
                //verificar que el usuario no este registrado
                $resultado =  $usuario->existeUusuario();

                if ($resultado->num_rows) {
                    $alertas = Usuario::getAlertas();
                } else {
                    //hashear el password
                    $usuario->hashPassword();

                    //henerar un token unico7

                    $usuario->crearToken();
                    //enviar el email

                    $email = new Email($usuario->email, $usuario->nombre, $usuario->token);
                    $email->enviarConfirmacion();

                    //crear el usuaario

                    $resultado = $usuario->guardar();

                    if ($resultado) {
                        header('Location: /mensaje');
                    }

                    //debuguear($usuario);
                }
            }
        }


        $router->render('auth/crear-cuenta', [
            'usuario' => $usuario,
            'alertas' => $alertas

        ]);
    }


    public static function recuperar(Router $router)
    {

        $alertas = [];
        $error = false;

        $token = s($_GET['token']);


        //buscar usuario por su token
        $usuario = Usuario::where('token', $token);


        if (empty($usuario)) {

            Usuario::setAlerta('error', 'token no valido');
            $error = true;
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            //leer el nuevo password

            $password = new  Usuario($_POST);

            $password->validarPassword();
            if (empty($alertas)) {

                $usuario->password = null;

                $usuario->password = $password->password;

                $usuario->hashPassword();

                $usuario->token = null;

                $resultado =  $usuario->guardar();

                if ($resultado) {
                    header('Location: /');
                }

                debuguear($usuario);
            }
        }



        $alertas = Usuario::getAlertas();

        $router->render('auth/recuperar-password', [
            'alertas' => $alertas,
            'error' => $error

        ]);
    }
    public static function mensaje(Router $router)
    {

        $router->render('auth/mensaje');
    }
    public static function confirmar(Router $router)
    {

        $alertas = [];

        //zanitizar
        $token = s($_GET['token']);

        $usuario = Usuario::where('token', $token);

        if (is_null($usuario)) {

            Usuario::setAlerta('error', 'token no valido');
        } else {

            //modificare al usuario confrimado
            $usuario->confirmado = "1";
            $usuario->token = "";

            $usuario->guardar();

            Usuario::setAlerta('exito', 'cuenta confirmada correctamente');
        }


        $alertas = Usuario::getAlertas();

        //renderizar la vista
        $router->render('auth/confirmar-cuenta', [
            'alertas' => $alertas

        ]);
    }
}