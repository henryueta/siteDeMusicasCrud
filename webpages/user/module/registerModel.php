<?php


function createRegisterModel($local){

    extract($_POST);
    extract($_FILES);
    require('../../../database/connect.php');

    $destinoFotos = "../../../imgs/user/" . md5(time() . $foto['size']) . ".jpg";
    session_start();
    $msg = "";
    $senha = password_hash($senha, PASSWORD_DEFAULT);
    $usuarioExiste = false;
    

    if($nome != "" && $email != "" && $senha != "" ){
        $queryAdmin = mysqli_query($banco, "SELECT * FROM `tb_admin` WHERE `email_admin` = '$email'");
        if($queryAdmin->num_rows == 1){
            $msg = "Email já cadastrado! Tente novamente.";
        } else {
            $queryUsuario = mysqli_query($banco, "SELECT * FROM `tb_usuario` WHERE `email_usuario` = '$email'");
            if($queryUsuario->num_rows == 1){
                $msg = "Email já cadastrado! Tente novamente.";
            } else {
                $registro = mysqli_query($banco, "INSERT INTO `tb_usuario`
                     (`id_usuario`, `nome_usuario`, `email_usuario`, `senha_usuario`, `foto_usuario`,`data_registro`) VALUES
                     (NULL, '$nome', '$email', '$senha', '$destinoFotos','$data')"); 
                if ($registro) {
                    move_uploaded_file($foto['tmp_name'], $destinoFotos);
                    $msg = "Registro concluido!!";
                } else {
                    $msg = "Erro ao criar registro! " . $banco->error;
                }
            }
        }
    } else{
        $msg = "Todos os campos devem ser preenchidos corretamente!";
    }
    $_SESSION['msg'] = $msg;

    header("location:".$local);


}