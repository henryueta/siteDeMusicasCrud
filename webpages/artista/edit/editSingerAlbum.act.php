<?php
require('../../../database/connect.php');

extract($_POST);
require('../../module/action/editElementRelation.php');

$response = [];
$msg = "Campo artista deve ser preenchido!";
$cond = false;


if (!empty(trim($idSingerList)) && isset($idSingerList)) {

    if (editElementRelation($banco, $idSingerList, 'fk_id_artista', 'tb_album_artista', 'fk_id_album', $idColetion, false)) {
        $cond = true;
    }
}

array_push($response, $cond, null, $msg);

echo json_encode($response);

    // if (!empty(trim($idSingerList))) {
    //     $idSingerList = explode(",", $idSingerList); //array
    // } else {
    //     $idSingerList = []; 
    // }
    
    // $albumArtista = mysqli_query($banco, "SELECT `fk_id_artista` FROM `tb_album_artista` WHERE `fk_id_album` = '$idColetion'");
    // $oldSingersAlbum = [];                     //fk_id_element        //tb_coletion_element          //fk_id_element     //value_id_coletion
    
    // while ($albumArtistaInfo = mysqli_fetch_assoc($albumArtista)) {
    //     $oldSingersAlbum[] = $albumArtistaInfo['fk_id_artista'];
    // }
    
    // $addSinger = array_diff($idSingerList, $oldSingersAlbum); 
    // $removeSinger = array_diff($oldSingersAlbum, $idSingerList); 
    
    // foreach ($addSinger as $newSingerId) {
    //     mysqli_query($banco, "INSERT INTO `tb_album_artista` (`id_album_artista`, `fk_id_artista`, `fk_id_album`) 
    //                 VALUES (NULL, '$newSingerId', '$idColetion')");
    // }                              
    
    // foreach ($removeSinger as $oldSingerId) {
    //     $deleteQuery = "DELETE FROM `tb_album_artista` 
    //                     WHERE `fk_id_album` = '$idColetion' AND `fk_id_artista` = '$oldSingerId'";
    //     mysqli_query($banco, $deleteQuery);
    // }
