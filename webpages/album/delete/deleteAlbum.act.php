<?php

require('../../../database/connect.php');



extract($_GET);

$return = false;
if(!trim(empty($id_album))){

$deleteAlbum = mysqli_query($banco,"DELETE FROM `tb_album` WHERE `id_album` = '$id_album'");

if($deleteAlbum){
    $return = true;
}


}

if(isset($redirect)){

header('location:../../admin/controller/albumData.php');

}

echo $return;



