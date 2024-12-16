<?php
extract($_GET);
require('../../../database/connect.php');
$msg = "";

if(mysqli_query($banco, "DELETE FROM `tb_artista` where `id_artista`='$id_artista'")){
    $msg = "Artista excluido com sucesso!";
}

$_SESSION['msg'] = $msg;

if(isset($redirect)){
    header("location:../../admin/controller/singerData.php");
}