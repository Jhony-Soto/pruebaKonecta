<?php

/**
 * Class Songs
 * This is a demo Model class.
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 */

namespace Mini\Model;

use Mini\Core\Model;

class ArticulosModel extends Model
{

    public $codigo;
    public $producto;
    public $referencia;
    public $precio;
    public $peso;
    public $categoria;
    public $stock;


    function __SET($atributo,$valor){
        $this->$atributo=$valor;
    }

    function __GET($atributo){
        return $this->$atributo;
    }


    /**
     * Get all songs from database
     */
    public function getArticulos()
    {
        $sql = "SELECT id,nombre_producto,referencia,precio,peso,id_categoria,(SELECT nombre_categoria from categoria where id=p.id_categoria)as categoria,stock FROM `productos` as p";
        $query = $this->db->prepare($sql);
        $query->execute();

        // fetchAll() is the PDO method that gets all result rows, here in object-style because we defined this in
        // core/controller.php! If you prefer to get an associative array as the result, then do
        // $query->fetchAll(PDO::FETCH_ASSOC); or change core/controller.php's PDO options to
        // $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC ...
        return $query->fetchAll();
    }

  
    public function addArticulo()
    {
        $fecha=date('Y-m-d');
        $sql = "INSERT INTO productos  VALUES (?,?,?,?,?,?,?,?)";
        $query = $this->db->prepare($sql);
        $parameters = array(0 => '',
                            1 => $this->producto,
                            2 => $this->referencia,
                            3 =>$this->precio,
                            4 => $this->peso,
                            5 => $this->categoria,
                            6 => $this->stock,
                            7 => $fecha);

        // useful for debugging: you can see the SQL behind above construction by using:
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();
        
         return $query->execute($parameters);
    }

    
    public function deleteArticulo()
    {
        $sql = "DELETE FROM productos WHERE id = :cod";
        $query = $this->db->prepare($sql);
        $parameters = array(':cod' => $this->codigo);

        // useful for debugging: you can see the SQL behind above construction by using:
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();

       return $query->execute($parameters);
    }

   
    public function Apdate_Articulos ()
    {
     
        try{
            $sql = "UPDATE productos SET nombre_producto=?,referencia=?,precio=?,peso=?,id_categoria=?,stock=? WHERE  id=?";
                $query = $this->db->prepare($sql);
                $parameters = array(0 => $this->producto,
                                    1=>$this->referencia,
                                    2=>$this->precio,
                                    3=>$this->peso,
                                    4=>$this->categoria,
                                    5=>$this->stock,
                                    6=>$this->codigo);

            return $query->execute($parameters);
        }catch(PDOException $e){
            return 'error'.$e->getMessage();
        }
        
    }


}
