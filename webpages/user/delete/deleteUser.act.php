<?php

require('../../../database/connect.php');

extract($_GET);

$msg = null;

$deleteUser = mysqli_query($banco,"DELETE FROM `tb_usuario` WHERE `id_usuario`='$id_usuario'");

if($deleteUser){
$msg = "Usuario deletado com sucesso!";
}

session_start();

$_SESSION['msg'] = $msg;

header('location:../../admin/controller/userData.php');
