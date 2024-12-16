<?php

extract($_POST);

require('../../../database/connect.php');

require('../../module/action/editElementRelation.php');
    
    


    $response = [];
$msg = "Campo musica deve ser preenchido!";
$cond = false;


if(isset($idMusicList)){
if (!empty(trim($idMusicList))) {

    if (editElementRelation($banco,$idMusicList,'fk_id_musica','tb_album_musica','fk_id_album',$idColetion,false)) {
        $cond = true;
    }
    
} 
}


array_push($response, $cond, null, $msg);

echo json_encode($response);