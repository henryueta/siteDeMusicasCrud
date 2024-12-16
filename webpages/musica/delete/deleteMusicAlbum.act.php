<?php

require('../../../database/connect.php');

extract($_GET);

if(!empty(trim($idMusicList))){

   $idMusicList =  explode(",",$idMusicList);
    
    foreach($idMusicList as $idMusic){

    $deleteMusicAlbum = mysqli_query($banco,"DELETE FROM `tb_album_musica` WHERE `id_album_musica` ='$idMusic'");  

    if($deleteMusicAlbum){
      echo $idMusic;
    }

    }    
    
    }

    