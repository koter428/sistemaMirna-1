<?php

include_once 'conexion/db.php';

class UsuarioSession {
    private $db;

    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $this->db = new DB();
    }

    /**
     * Verifica si existe el usuario y la contraseña (MD5) coinciden.
     * Muestra información de depuración para diagnóstico.
     */
    public function existeUsuario($usuario, $pass) {
        $conexion = $this->db->conectar();

        // conversor a md5
        $passMD5 = md5($pass);

        // Primero verificamos si el usuario existe y obtengo la password en DB
        $checkUser = $conexion->prepare("SELECT nick_name, `password` FROM usuarios WHERE nick_name = :usuario LIMIT 1");
        $checkUser->execute(['usuario' => $usuario]);
        $userData = $checkUser->fetch(PDO::FETCH_ASSOC);

        if (!$userData) {
            echo "Usuario no encontrado en la base de datos<br>";
            return false;
        }

        // Depuración: mostrar hash en DB y el hash ingresado
        echo "Usuario encontrado. Password en DB: " . $userData['password'] . "<br>";
        echo "Password ingresado (MD5): " . $passMD5 . "<br>";

        // Consulta para autenticar
        $query = $conexion->prepare("SELECT
            u.cod_usuario,
            u.nom_apellido,
            u.cod_rol,
            r.descripcion AS rol
            FROM usuarios u
            JOIN roles r ON r.cod_rol = u.cod_rol
            WHERE u.nick_name = :usuario AND u.`password` = :pass
            LIMIT 1");

        $query->execute(['usuario' => $usuario, 'pass' => $passMD5]);

        if ($query->rowCount()) {
            $user = $query->fetch(PDO::FETCH_ASSOC);
            $_SESSION['cod_usuario'] = $user['cod_usuario'];
            $_SESSION['id_user'] = $user['cod_usuario'];
            $_SESSION['rol'] = $user['rol'];
            $_SESSION['cod_rol'] = $user['cod_rol'];
            $_SESSION['nom_apellido'] = $user['nom_apellido'];
            return true;
        }

        return false;
    }

    public function bloquearUsuario($usuario) {
        $query = $this->db->conectar()->prepare("UPDATE usuarios SET estado = 'BLOQUEADO' WHERE nick_name = :usuario");
        $query->execute(['usuario' => $usuario]);
    }

    public function actualizatIntentos($usuario, $intentos) {
        $query = $this->db->conectar()->prepare("UPDATE usuarios SET intentos = :intentos WHERE nick_name = :usuario");
        $query->execute(['usuario' => $usuario, 'intentos' => $intentos]);
    }

    public function dameIntentos($usuario) {
        $query = $this->db->conectar()->prepare("SELECT intentos FROM usuarios WHERE nick_name = :usuario LIMIT 1");
        $query->execute(['usuario' => $usuario]);
        $row = $query->fetch(PDO::FETCH_ASSOC);
        return $row ? (int)$row['intentos'] : 0;
    }

    public function dameLimiteIntentos($usuario) {
        $query = $this->db->conectar()->prepare("SELECT limite_intentos FROM usuarios WHERE nick_name = :usuario LIMIT 1");
        $query->execute(['usuario' => $usuario]);
        $row = $query->fetch(PDO::FETCH_ASSOC);
        return $row ? (int)$row['limite_intentos'] : 0;
    }

    public function usuarioLogeado() {
        return isset($_SESSION['cod_usuario']);
    }

    public function getNombre() {
        return isset($_SESSION['nom_apellido']) ? $_SESSION['nom_apellido'] : '';
    }

    public function getIdUsuario() {
        return isset($_SESSION['id_user']) ? $_SESSION['id_user'] : null;
    }

    //----- Funciones para administradores (si existen tablas separadas) -----
    public function existeAdmin($usuario, $pass) {
        $passMD5 = md5($pass);
        $query = $this->db->conectar()->prepare("SELECT nombre_apellido, id_usuario FROM usuario WHERE nombre = :usuario AND clave = :pass LIMIT 1");
        $query->execute(['usuario' => $usuario, 'pass' => $passMD5]);
        if ($query->rowCount()) {
            $user = $query->fetch(PDO::FETCH_ASSOC);
            $_SESSION['nombre_apellido_admin'] = $user['nombre_apellido'];
            $_SESSION['id_usuario'] = $user['id_usuario'];
            return true;
        }
        return false;
    }

    public function adminLogeado() {
        return isset($_SESSION['id_usuario']);
    }

    public function getNombreAdmin() {
        return isset($_SESSION['nombre_apellido_admin']) ? $_SESSION['nombre_apellido_admin'] : '';
    }

    public function getIdAdmin() {
        return isset($_SESSION['id_usuario']) ? $_SESSION['id_usuario'] : null;
    }
}

