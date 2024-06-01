<?php

namespace Model;

use Clases\Email;

class Usuario extends ActiveRecord
{

    //base de datos

    protected static $tabla = 'usuarios';
    protected static $columnasDB = ['id', 'nombre', 'apellido', 'fecha_nacimiento', 'email', 'password', 'telefono', 'admin', 'confirmado', 'token'];


    public $id;
    public $nombre;
    public $apellido;
    public $fecha_nacimiento;
    public $email;
    public $password;
    public $telefono;
    public $admin;
    public $confirmado;
    public $token;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->apellido = $args['apellido'] ?? '';
        $this->fecha_nacimiento = $args['fecha_nacimiento'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
        $this->admin = $args['admin'] ?? '0';
        $this->confirmado = $args['confirmado'] ?? '0';
        $this->token = $args['token'] ?? '';
    }

    ///mensajes de validacion para la creacion de la cuenta

    public function validarNuevaCuenta()
    {

        $nac = $this->fecha_nacimiento;
        $nuevo = strtotime($nac);

        $nueva_fecha = date('Y-m-d');
        if (!$this->nombre) {
            self::$alertas['error'][] = 'El nombre es obligatorio';
        }
        if (!$this->apellido) {
            self::$alertas['error'][] = 'El apellido es obligatorio';
        }


        if (!$this->fecha_nacimiento) {


            self::$alertas['error'][] = 'La fecha de nacimiento es obligatorio'; ///
        } else if ($nuevo >= $nueva_fecha) {


            self::$alertas['error'][] = 'elija  una fecha valida';
        }



        if (!$this->telefono) {
            self::$alertas['error'][] = 'El telefono es obligatorio';
        }
        if (!$this->email) {
            self::$alertas['error'][] = 'El email es obligatorio';
        }
        if (strlen($this->password) < 6) {
            self::$alertas['error'][] = 'El password debe contener al menos 6 caracteres';
        }


        return self::$alertas;
    }
    //validar correo y password
    public  function validarLogin()
    {
        if (!$this->email) {
            self::$alertas['error'][] = 'el email es obligatorio';
        }

        if (!$this->password) {
            self::$alertas['error'][] = 'el password es obligatorio';
        }

        return self::$alertas;
    }

    public function validarEmail()
    {
        if (!$this->email) {
            self::$alertas['error'][] = 'el email es obligatorio';
        }

        return self::$alertas;
    }
    public function validarPassword()
    {

        if (!$this->password) {
            self::$alertas['error'][] = 'el password es obligatorio';
        }
        if (strlen($this->password) < 6) {
            self::$alertas['error'][] = 'el password debe tener al menos 6 caracteres';
        }

        return self::$alertas;
    }

    //revisa si el usuario ya existe
    public  function existeUusuario()
    {
        $query = "SELECT * FROM " . self::$tabla . " WHERE email = '" . $this->email . "' LIMIT 1";


        $resultado = self::$db->query($query);

        if ($resultado->num_rows) {

            self::$alertas['error'][] = 'el usuario ya esta registrado';
        }

        return $resultado;
    }

    public function hashPassword()
    {
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
    }

    public function crearToken()
    {
        //genera un id unico 
        $this->token = uniqid();
    }

    public function comprobarPasswordVerificado($password)
    {
        $resultado = password_verify($password, $this->password);
        //  debuguear($resultado);

        if (!$resultado) {

            self::$alertas['error'][] = 'password Incorrecto o tu cuenta no ha sido confirmada';
        } else {
            return true;
        }
    }
}
