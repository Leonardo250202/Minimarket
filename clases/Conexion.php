<?php
class conectar{
    private $servidor="localhost";
    private $usuario="root";
    private $password="root";
    private $bd="ventas2";

    public function conexion(){
        $conexion=mysqli_connect($this->servidor,
        $this->usuario,
        $this->password,
        $this->bd);

        return $conexion;
    }
} 
?>