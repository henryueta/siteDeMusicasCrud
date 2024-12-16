<?php

session_start();

extract($_POST);
require('../../../database/connect.php');


if(isset($nomePlaylist)){

    $playListRegister = mysqli_query($banco,"UPDATE `tb_playlist` SET
    `nome_playlist` = '$nomePlaylist' WHERE `id_playlist` = '$idPlaylist'; ");

}
    

if($playListRegister){

    $playlist = mysqli_query($banco,"SELECT *FROM `tb_playlist` WHERE `id_playlist` = '$idPlaylist'");

    $playlistInfo = mysqli_fetch_assoc($playlist);

    echo "$playlistInfo[nome_playlist]";

}
