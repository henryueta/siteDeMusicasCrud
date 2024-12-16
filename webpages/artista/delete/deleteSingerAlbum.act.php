<?php

function deleteSinger($database,$albumSingerId){
    
    return mysqli_query($database,"DELETE FROM `tb_album_artista` WHERE `id_album_artista` ='$albumSingerId'"); 

}

