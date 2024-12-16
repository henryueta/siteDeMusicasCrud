<?php
extract($_GET);
require('../../../database/connect.php');

session_start();
$msg = "";

    if(mysqli_query($banco, "DELETE FROM `tb_categoria` WHERE `id_categoria` = '$id_categoria'")){
        $msg = "Categoria excluída comsucesso!";
    }

$_SESSION['msg'] = $msg;
header('location:../../admin/controller/categoryData.php');