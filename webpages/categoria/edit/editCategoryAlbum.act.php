<?php

extract($_POST);

require('../../../database/connect.php');


require('../../module/action/editElementRelation.php');



$response = [];
$msg = "Campo categoria deve ser preenchido!";
$cond = false;


if (isset($idCategoryList)) {
    if (!empty(trim($idCategoryList))) {

        if (editElementRelation($banco, $idCategoryList, 'fk_id_categoria', 'tb_album_categoria', 'fk_id_album', $idColetion, false)) {
            $cond = true;
        }
    }
}


array_push($response, $cond, null, $msg);

echo json_encode($response);
