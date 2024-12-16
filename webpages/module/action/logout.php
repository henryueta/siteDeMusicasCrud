<?php

session_start();

if(isset($_SESSION['logado'])){
    $_SESSION['logado'] = false;
    unset($_SESSION['nome']);
    unset($_SESSION['foto']);

} 

if(isset($_SESSION['admLogado'])){
    $_SESSION['admLogado'] = false;
    unset( $_SESSION['admNome']);
    unset($_SESSION['admFoto']);
    unset($_SESSION['admTipo']);

}

session_destroy();

header('location:../../user/login/login.php');
