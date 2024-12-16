<?php
    require('../../../database/connect.php');
    extract($_POST);
    session_start();
    $destino = "";
    $msg = "";
    
    if($email != "" && $senha != ""){
        $usuario = mysqli_query($banco, "SELECT * FROM `tb_usuario` WHERE `email_usuario` = '$email'");

        if($usuario -> num_rows == 1){
            $user = mysqli_fetch_assoc($usuario);
            echo 1;
            if(password_verify($senha, $user['senha_usuario'])){
                echo 2;
                $_SESSION['logado'] = true;
                $_SESSION['nome'] = $user['nome_usuario'];
                $_SESSION['foto'] = $user['foto_usuario'];
                $_SESSION['id'] = $user['id_usuario'];
                $destino = "location:../../globalView/navigation/explorer.php";
            } else{
                $msg = "Senha Incorreta!";
                $destino = "location:login.php";
            }
        }else{

            $admin = mysqli_query($banco,"SELECT * FROM `tb_admin` WHERE `email_admin` = '$email'");

            if($admin -> num_rows == 1){
                $administrador = mysqli_fetch_assoc($admin);

                if(password_verify($senha, $administrador['senha_admin'])){       
                    $_SESSION['admLogado'] = true;
                    $_SESSION['admNome'] = $administrador['nome_admin'];
                    $_SESSION['admFoto'] = $administrador['foto_admin'];
                    $_SESSION['admTipo'] = $administrador['tipo_admin'];
                    $_SESSION['admId'] = $administrador['id_admin'];
                    $msg = "Admistrador detectado";
                    $destino = "location:../../globalView/navigation/explorer.php";
                }else{
                $msg = "Senha Incorreta!";
                $destino = "location:login.php";
            }
        }else{
            $msg = "Email Incorreto!";
            $destino = "location:login.php";
        } 

        } 

    } else{
        $msg = "Todo os campos devem ser preenchidos!";
        $destino = "location:login.php";
    }   

    header($destino);
    $_SESSION['msg'] = $msg;
