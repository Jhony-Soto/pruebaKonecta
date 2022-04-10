<?php
namespace Mini\Controller;

use Mini\Model\ventasModel;


class VentasController extends ventasModel
{
    private $articulos;
    private $categorias;

    function __construct(){
        $this->ventas=new ventasModel();
    }

    function index(){
        $titulo='VENTAS';
        $script=[
                'js/ventas/index.js'
                ];
        
        require_once APP.'view/_templates/header.php';
        require_once APP.'view/_templates/panel.php';
        require_once APP.'view/ventas/index.php';
        require_once APP.'view/_templates/footer.php';
    }


    public function generate_venta(){
        $productos=json_decode($_POST['compra']);
        $id=$this->ventas->addVenta();
        foreach($productos as $item){
            $this->ventas->__SET('id_venta',$id);
            $this->ventas->__SET('id_producto',$item->id);
            $this->ventas->__SET('cantidad',$item->cantidad);
            $this->ventas->__SET('precio',$item->precio);
            $this->ventas->insert_venta_producto();
            
            // Update stock
            $existencia=$item->existencia-$item->cantidad;
            $this->ventas->__SET('existencia',$existencia);
            $this->ventas->editStocks();
        }

        echo json_encode(['status'=>true]);
    }

    public function getTops(){
        $masventa= $this->ventas->getProductoMasVendido();
        $masStock= $this->ventas->getProductoMasStock();
        echo json_encode(['top_venta'=>$masventa,'topStock'=>$masStock]);
    }

}