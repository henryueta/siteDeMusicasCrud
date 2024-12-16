<?php

require('../../../database/connect.php');

extract($_POST);

$dados= [];


$total = mysqli_query($banco,"SELECT COUNT(*) AS `total` FROM `$table`");

$totais = mysqli_fetch_assoc(($total));

$data = mysqli_query($banco,"SELECT DATE(`data_registro`) 
AS `dia`, COUNT(*) 
AS `new_register` FROM `$table` WHERE `data_registro` BETWEEN '$primeiroDia' AND '$ultimoDia' GROUP BY `dia`");



while($listaData = mysqli_fetch_assoc($data)){

    $dados[] = [
        'dia' => $listaData['dia'], 
        'new_register' => $listaData['new_register'],
        'total' => $totais['total']
    ];

}

echo json_encode($dados);
