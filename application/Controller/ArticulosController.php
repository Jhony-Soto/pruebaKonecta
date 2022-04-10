<?php
namespace Mini\Controller;
use Mini\Model\ArticulosModel;
use Mini\Model\categoriaModel;


class ArticulosController extends ArticulosModel
{
    private $articulos;
    private $categorias;

    function __construct(){
        $this->articulos=new ArticulosModel();
        $this->categorias=new categoriaModel();
    }

    function index(){
            $titulo='ARTICULOS';

            $script=[
                    'js/Articulos/articulos.js'
                    ];
            
            require_once APP.'view/_templates/header.php';
            require_once APP.'view/_templates/panel.php';
            require_once APP.'view/Articulos/index.php';
            require_once APP.'view/_templates/footer.php';

    }

    function getArticulos(){
        $res=$this->articulos->getArticulos();
        echo \json_encode(['status'=>200,'data'=>$res]);
    }
    
    function getCategorias(){
        $categoria=$this->categorias->getAll();
        echo \json_encode(['status'=>200,'data'=>$categoria]);
    }


    function saveArticulo(){
        
        $this->articulos->__SET('producto',$_POST['nombre_articulo']);
        $this->articulos->__SET('referencia',$_POST['referencia_articulo']);
        $this->articulos->__SET('precio',$_POST['precio_articulo']);
        $this->articulos->__SET('peso',$_POST['peso_articulo']);
        $this->articulos->__SET('categoria',$_POST['categoria']);
        $this->articulos->__SET('stock',$_POST['stock_articulo']);
        $res=$this->articulos->addArticulo();
            
    }

  

    function update(){

        $this->articulos->__SET('codigo',$_POST['id_articulo']);
        $this->articulos->__SET('producto',$_POST['nombre_articulo']);
        $this->articulos->__SET('referencia',$_POST['referencia_articulo']);
        $this->articulos->__SET('precio',$_POST['precio_articulo']);
        $this->articulos->__SET('peso',$_POST['peso_articulo']);
        $this->articulos->__SET('categoria',$_POST['categoria']);
        $this->articulos->__SET('stock',$_POST['stock_articulo']);
        $res=$this->articulos->Apdate_Articulos();
      
    }

    function delete(){
        $this->articulos->__SET('codigo',$_POST['id_articulo']);
        $res=$this->articulos->deleteArticulo();
        
    }


   
}

