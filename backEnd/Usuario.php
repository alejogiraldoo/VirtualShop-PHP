<?php
    // Clase Usuario
    class Usuario{
        // ATRIBUTOS
        private $numUsu;
        private $id;
        private $nombre;
        private $direccion;
        private $telefono;
        private $usuario;
        private $correo;
        private $contrasena;
        private $rol;

        // CONSTRUCTOR
        public function __construct($_numUsu,$_id,$_nombre,$_direccion,$_telefono,$_usuario,$_correo,$_contrasena,$_rol){
            $this->numUsu = $_numUsu;
            $this->id = $_id;
            $this->nombre = $_nombre;
            $this->direccion = $_direccion;
            $this->telefono= $_telefono;
            $this->usuario = $_usuario;
            $this->correo = $_correo;
            $this->contrasena = $_contrasena;
            $this->rol = $_rol;
        }
        
        //____________________METODO GET____________________

        public function getNumUsu(){
            return $this->numUsu;
        }

        public function getId(){
           return $this->id;
        }

        public function getNombre(){
            return $this->nombre;
        }

        public function getTelefono(){
            return $this->telefono;
        }

        public function getDireccion(){
            return $this->direccion;
        }

        public function getUsuario(){
            return $this->usuario;
        }

        public function getCorreo(){
            return $this->correo;
        }

        public function getContrasena(){
            return $this->contrasena;
        }

        public function getRol(){
            return $this->rol;
        }

        //____________________METODO SET____________________

        public function setRol($_rol){
            $this->rol = $_rol;
        }
    }
?>