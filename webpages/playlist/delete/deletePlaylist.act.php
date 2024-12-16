<?php

require('../../../database/connect.php');


extract($_GET);

$return = false;
if(!trim(empty($idPlaylist))){

$deletePlaylist = mysqli_query($banco,"DELETE FROM `tb_playlist` WHERE `id_playlist` = '$idPlaylist'");

if($deletePlaylist){
    $return = true;
}


}

echo $return;