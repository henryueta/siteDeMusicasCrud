<?php

define("ENDERECO", 'localhost');
define("USUARIO", 'root');
define("SENHA", '');
define("BASE", 'bd_hypp');
$banco = mysqli_connect(ENDERECO, USUARIO, SENHA, BASE);
mysqli_query($banco, "SET NAMES utf8");
