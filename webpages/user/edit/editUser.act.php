<?php

require('../../../database/connect.php');
require('../../module/action/files.php');

extract($_POST);
extract($_FILES);
$msg = null;
$senhaNova = null;
$fotoNova = null;


if (!empty(trim($nome))) {
    if (!empty(trim($email))) {

        if(!empty(trim($senha))){
            $senhaNova = password_hash($senha,PASSWORD_DEFAULT);
        } else{
            $senhaNova = $senhaAntiga;
        }
        if(!empty(trim($foto))){
            $fotoNova = editElementFile($foto,$fotoAntiga,".jpg","../../../imgs/user/");
        } else{
            $fotoNova = $fotoAntiga;
        }

        $userRegister = mysqli_query($banco, "UPDATE `tb_usuario` SET 
        `nome_usuario` = '$nome',
        `email_usuario` = '$email',
        `senha_usuario` = '$senhaNova',
        `foto_usuario` = '$fotoNova'
        WHERE `id_usuario` = '$id'");

        if($userRegister){
            $msg = "Usuário alterado com sucesso";
        }

    } else {
        $msg = "Campo e-mail deve ser preenchido!";
    }
} else {
    $msg = "Campo nome precisa ser preenchido!";
}

echo $msg;