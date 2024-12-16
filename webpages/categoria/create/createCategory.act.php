<?php

require('../../../database/connect.php');


extract($_POST);

$response = [];
$msg = "";
$cond = false;
$query = "";


$categoryQuery = mysqli_query($banco, "SELECT * FROM `tb_categoria` WHERE `nome_categoria` = '$nomeCategoria'");
        if($categoryQuery->num_rows == 1){
            $msg = "Categoria já cadastrada! Tente novamente.";
        }
else{
if(!empty(trim($nomeCategoria))){

$categoriaRegister = mysqli_query($banco,"INSERT INTO `tb_categoria`
(`id_categoria`,`nome_categoria`)
VALUES(NULL,'$nomeCategoria')");

if($categoriaRegister){
    $cond = true;
}

} else{
    $msg = "Campo nome precisa ser preenchido!";
}
}

$category = mysqli_query($banco,"SELECT *FROM `tb_categoria`;");

    while($categories = mysqli_fetch_assoc($category)){
       
    $query = $query . "<div data-value=$categories[id_categoria]>
    
    $categories[nome_categoria]
    
    </div>";
        
    }

array_push($response,$cond,$query,$msg);

echo json_encode($response);


