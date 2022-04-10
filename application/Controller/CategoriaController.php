<?php
namespace Mini\Controller;
use Mini\Model\categoriaModel;


class CategoriaController extends categoriaModel
{

    private $categoriaModel;

    function __construct(){
        $this->categoriaModel=new categoriaModel();
    }

    public function index(){
        $titulo='CATEGORIAS';

        $script=[
                'js/categorias/categoria.js'
                ];
        
        require_once APP.'view/_templates/header.php';
        require_once APP.'view/_templates/panel.php';
        require_once APP.'view/categorias/index.php';
        require_once APP.'view/_templates/footer.php';
    }

    function getCategorias(){

        $res=$this->categoriaModel->getAll();
        echo json_encode(['status'=>200,"data"=>$res]);
        
    }

    function saveCategoria(){
        $this->categoriaModel->__SET('nombre',$_POST['name_categoria']);
        $res=$this->categoriaModel->saveCategoria();
    }
    function editCategoria(){
        $this->categoriaModel->__SET('id',$_POST['id_categoria']);
        $this->categoriaModel->__SET('nombre',$_POST['name_categoria']);
        $res=$this->categoriaModel->editCategoria();
    }
    function delete_categoria(){
        $this->categoriaModel->__SET('id',$_POST['id_categoria']);
        $res=$this->categoriaModel->delete_categoria();
    }
}
