<?php

namespace Mini\Model;

use PDO;
use Mini\Core\model;

class categoriaModel extends Model
{
    private $id;
    private $nombre; 

    //CLASE QUE TIENE LA CONEXION
    function __construct(){
        parent::__construct();
    }

    function __SET($atributo,$valor){
        $this->$atributo=$valor;
    }

    function __GET($atributo){
        return $this->$atributo;
    }


    //OBTENEMOS TODAS LAS CATEGORIAS
    function getAll(){
        $sql="SELECT * FROM categoria";
        $strms=$this->db->prepare($sql);
        $strms->execute();
        return $strms->fetchAll();
    }

    function saveCategoria(){
        $fecha=date('Y-m-d');
        $sql = "INSERT INTO categoria (id,nombre_categoria,created) VALUES (?,?,?)";
        $query = $this->db->prepare($sql);
        $parameters = array(0 => '',
                            1 => $this->nombre,
                            2=>$fecha);
                            
         return $query->execute($parameters);
    }
    function editCategoria(){
        $sql = "UPDATE categoria SET nombre_categoria=? WHERE id=?";
        $query = $this->db->prepare($sql);
        $parameters = array(0 => $this->nombre,
                            1 =>$this->id);
                            
         return $query->execute($parameters);
    }
    function delete_categoria(){
        $sql = "DELETE FROM categoria WHERE id = :cod";
        $query = $this->db->prepare($sql);
        $parameters = array(':cod' => $this->id);

       return $query->execute($parameters);
    }




}
