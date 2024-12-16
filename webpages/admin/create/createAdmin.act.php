<?php
    session_start();
    extract($_POST);
    require('../../../database/connect.php');
    $senha = password_hash($senha, PASSWORD_DEFAULT);
    $msg = "";

    if ($nome != "" && $email != "" && $senha != "" && $tipo != "") {
        if ($_SESSION['admTipo'] == "master") {
            $queryAdmin = mysqli_query($banco, "SELECT * FROM `tb_admin` WHERE `email_admin` = '$email'");
            if ($queryAdmin->num_rows == 1) {
                $msg = "Email já cadastrado! Tente novamente.";
            } else {
                $queryUsuario = mysqli_query($banco, "SELECT * FROM `tb_usuario` WHERE `email_usuario` = '$email'");
                if ($queryUsuario->num_rows == 1) {
                    $msg = "Email já cadastrado! Tente novamente.";
                } else {
                    $registro = mysqli_query($banco, "INSERT INTO `tb_admin` 
                        (`id_admin`, `nome_admin`, `email_admin`, `senha_admin`, `tipo_admin`) VALUES
                        (NULL, '$nome', '$email', '$senha', '$tipo')");
                    if ($registro) {
                        $msg = "Registro feito com sucesso!!!!";
                    } else{
                        $msg = "Erro ao fazer cadastro ". $banco->error;
                    }
                }
            }
        } else{
           $msg = "É preciso ser um administrador Master para fazer este cadastrado!"; 
        }
    } else if($tipo != "master" || $tipo != "common"){
        $msg = "Campo de texto em tipo inválido!
        $tipo   ";
    } else {
        $msg = "Todos os campos devem ser preenchidos corretamente!";
    } 

    $_SESSION['msg'] = $msg;
    header("location:createAdmin.php");