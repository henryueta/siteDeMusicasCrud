<?php
extract($_GET);
require('../../../database/connect.php');
$msg = "";
if(mysqli_query($banco, "DELETE FROM `tb_admin` where `id_admin`='$id_admin'")){
    $msg = "Administrador excluido com sucesso!";
}

$_SESSION['msg'] = $msg;
header("location:../../admin/controller/adminData.php");      
