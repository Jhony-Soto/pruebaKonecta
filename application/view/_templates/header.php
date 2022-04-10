<?php 
    $root=$_SERVER['DOCUMENT_ROOT'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>KONECTA - <?= $titulo ?></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

  
    <link rel="stylesheet" href="<?= URL ?>css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= URL ?>css/alertify.min.css">
    <link rel="stylesheet" href="<?= URL ?>css/alertify.css">
    <link rel="stylesheet" href="<?= URL ?>fonts/style.css">
    <link rel="stylesheet" href="<?= URL ?>fonts/css/all.css">
    <!-- DATATABLES -->
    <link rel="stylesheet" href="<?= URL ?>css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= URL ?>css/responsive.bootstrap4.min.cs">

    <!-- SELECT2 -->
    <link rel="stylesheet" href="<?= URL ?>css/select2.css">

    <?php
        if(isset($estilos)){
            for($i=0;$i<count($estilos);$i++){
               echo '<link rel="stylesheet" href="'.URL.$estilos[$i].'">';
            }
        }
    ?>

</head>
<body class="hold-transition sidebar-mini">
  <div class="wrapper">


