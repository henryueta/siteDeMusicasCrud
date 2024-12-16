<?php

extract($_POST);
session_start();
require('../../../database/connect.php');

$senhaNova = null;
$msg = "";

if (!empty(trim($nome))) {
    if (!empty(trim($email))) {
        if(!empty(trim($tipo))){
        if(!empty(trim($senha))){
            $senhaNova = password_hash($senha,PASSWORD_DEFAULT);
        } else{
            $senhaNova = $senhaAntiga;
        }

        if($tipo == "master" || $tipo == "common"){
           $adminRegister = mysqli_query($banco, "UPDATE  `tb_admin` SET 
             `nome_admin` = '$nome', 
             `email_admin` = '$email',
             `senha_admin` = '$senhaNova',
            `tipo_admin` = '$tipo' WHERE `id_admin` = '$id'");
        }

        if($adminRegister){
            $msg = "Administrador alterado com sucesso";
        }
    } else{
        $msg = "Campo tipo deve ser preenchido!";
    }
    } else {
        $msg = "Campo e-mail deve ser preenchido!";
    }
} else {
    $msg = "Campo nome precisa ser preenchido!";
}

echo $msg;