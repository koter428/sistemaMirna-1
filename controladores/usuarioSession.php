<?php

include_once 'conexion/db.php';

class UsuarioSession {

    public function __construct() {
        session_start();
    }

    public function existeUsuario($usuario, $pass) {

        //conversor  a md5
        $passMD5 = md5($pass);
        //instancia de la clase BD para conexiones con la base de datos
        $db = new DB();

        //preparamos la sentencia a ser ejecutada
        $query = $db->conectar()->prepare("SELECT
            u.cod_usuario,
            u.nom_apellido,
            u.cod_rol,
            r.descripcion AS rol
            FROM usuarios u 
            JOIN roles r 
            ON r.cod_rol = u.cod_rol
            WHERE u.nick_name = :usuario AND u.`password` = :pass ");
        //agregamos los valores a la consulta mediante la ayuda de un diccionario
        $query->execute(['usuario' => $usuario, 'pass' => $passMD5]);

        if ($query->rowCount()) {

            foreach ($query as $user) {
                $_SESSION['cod_usuario'] = $user['cod_usuario'];
                $_SESSION['id_user'] = $user['cod_usuario'];
                $_SESSION['rol'] = $user['rol'];
                $_SESSION['cod_rol'] = $user['cod_rol'];
                $_SESSION['nom_apellido'] = $user['nom_apellido'];

                return true;
            }
        } else {
            return false;
        }
    }

    public function bloquearUsuario($usuario) {


        //instancia de la clase BD para conexiones con la base de datos
        $db = new DB();

        //preparamos la sentencia a ser ejecutada
        $query = $db->conectar()->prepare("UPDATE usuarios SET estado = 'BLOQUEADO' 
        WHERE  nick_name LIKE :usuario");
        //agregamos los valores a la consulta mediante la ayuda de un diccionario
        $query->execute(['usuario' => $usuario]);
    }

    public function actualizatIntentos($usuario, $intentos) {


//        instancia de la clase BD para conexiones con la base de datos
//        echo "<script> alert($usuario); alert($intentos); </script>";
        $db = new DB();
        //preparamos la sentencia a ser ejecutada
        $query = $db->conectar()->prepare("UPDATE usuarios SET intentos = :intentos 
        WHERE  nick_name LIKE :usuario");
        //agregamos los valores a la consulta mediante la ayuda de un diccionario
        $query->execute(['usuario' => $usuario, 'intentos' => $intentos]);
    }

    public function dameIntentos($usuario) {


        //instancia de la clase BD para conexiones con la base de datos
        $db = new DB();

        //preparamos la sentencia a ser ejecutada
        $query = $db->conectar()->prepare("SELECT intentos FROM usuarios  
        WHERE  nick_name LIKE :usuario limit 1");
        //agregamos los valores a la consulta mediante la ayuda de un diccionario
        $query->execute(['usuario' => $usuario]);

        if ($query->rowCount()) {

            foreach ($query as $user) {


                return $user['intentos'];
            }
        } else {
            return 0;
        }
    }

    public function dameLimiteIntentos($usuario) {


        //instancia de la clase BD para conexiones con la base de datos
        $db = new DB();

        //preparamos la sentencia a ser ejecutada
        $query = $db->conectar()->prepare("SELECT limite_intentos FROM usuarios  
        WHERE  nick_name LIKE :usuario");
        //agregamos los valores a la consulta mediante la ayuda de un diccionario
        $query->execute(['usuario' => $usuario]);

        if ($query->rowCount()) {

            foreach ($query as $user) {


                return $user['limite_intentos'];
            }
        } else {
            return 0;
        }
    }

    public function usuarioLogeado() {
        if (isset($_SESSION['cod_usuario'])) {
            return true;
        } else {
            return false;
        }
    }

    public function getNombre() {
        return $_SESSION['nomEmpleado'];
    }

    public function getIdCliente() {
        return $_SESSION['id_user'];
    }

//##############################################################################
//##############################################################################
//##############################PARA ADMINISTRADORES#######################
//##############################################################################
//##############################################################################

    public function existeAdmin($usuario, $pass) {

        //conversor  a md5
        $passMD5 = md5($pass);
        //instancia de la clase BD para conexiones con la base de datos
        $db = new DB();

        //preparamos la sentencia a ser ejecutada
        $query = $db->conectar()->prepare("SELECT nombre_apellido,"
                . "id_usuario FROM usuario WHERE nombre = :usuario "
                . "and clave = :pass;");
        //agregamos los valores a la consulta mediante la ayuda de un diccionario
        $query->execute(['usuario' => $usuario, 'pass' => $passMD5]);

        if ($query->rowCount()) {

            foreach ($query as $user) {
                $_SESSION['nombre_apellido_admin'] = $user['nombre_apellido'];
                $_SESSION['id_usuario'] = $user['id_usuario'];

                return true;
            }
        } else {
            return false;
        }
    }

    /**
     * 
     * @return boolean
     */
    public function adminLogeado() {
        if (isset($_SESSION['cod_usuario'])) {
            return true;
        } else {
            return false;
        }
    }

    public function getNombreAdmin() {
        return $_SESSION['nombre_apellido_admin'];
    }

    public function getIdAdmin() {
        return $_SESSION['id_user'];
    }
}
