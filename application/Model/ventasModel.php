<?php


namespace Mini\Model;

use Mini\Core\Model;
use PDO;
use Mini\Libs\Helper;

class ventasModel extends Model
{

    private $id_venta;
    private $id_producto; 
    private $cantidad; 
    private $precio; 
    private $existencia; 

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


    // INSERTAR
    function addVenta(){
        $fecha=date('Y-m-d');
        $sql="INSERT into venta values(?,?)";
        $strm=$this->db->prepare($sql);
        $parameters = array(0 => '',
                            1=>$fecha);            
        $strm->execute($parameters);
        return $this->db->lastInsertId();
    }

    function insert_venta_producto(){
        $fecha=date('Y-m-d');
        $sql="INSERT into venta_producto values(?,?,?,?,?,?)";
        $strm=$this->db->prepare($sql);
        $parameters = array(0 => '',
                            1=>$this->id_venta,
                            2=>$this->id_producto,
                            3=>$this->cantidad,
                            4=>$this->precio,
                            5=>$fecha,
                        );            
        $strm->execute($parameters);
    }

    function editStocks(){
        $sql = "UPDATE productos SET stock=? WHERE id=?";
        $query = $this->db->prepare($sql);
        $parameters = array(0 => $this->existencia,
                            1 =>$this->id_producto);
                 
        return $query->execute($parameters);
    }

    function getProductoMasVendido(){
        $sql = "SELECT  vp.id_producto, sum(vp.cantidad) as ventas
                FROM `venta_producto` vp
                    inner join productos p on p.id=vp.id_producto
                group by vp.id_producto
                order by ventas desc LIMIT 1;";

        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }

    function getProductoMasStock(){
        $sql = "SELECT * FROM `productos` ORDER by stock DESC LIMIT 1;";
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }


} 
