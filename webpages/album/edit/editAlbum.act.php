<?php

session_start();

extract($_POST);

extract($_FILES);

require('../../../database/connect.php');


$album = mysqli_query($banco,"SELECT `foto_album` FROM `tb_album` WHERE `id_album`='$id_album'");
$fotoAlbumAntiga = mysqli_fetch_assoc($album);


if(isset($fotoAlbumNova)){
    $foto = "../../../imgs/album/".md5(time().$fotoAlbumNova['size']).".jpg";
} else {
    $foto = $fotoAlbumAntiga['foto_album'];
}

if(isset($nomeAlbum)){

    $albumRegister = mysqli_query($banco,"UPDATE `tb_album` SET
    `nome_Album` = '$nomeAlbum',
    `qnt_musica` = '$qnt_musica',
    `qnt_categoria` = '$qnt_categoria',
    `qnt_artista`= '$qnt_artista',
    `foto_album` = '$foto'
     WHERE `id_album` = '$id_album'; ");

}
    

if($albumRegister){

    if(isset($fotoAlbumNova)){
        move_uploaded_file($fotoAlbumNova['tmp_name'],$foto);
    }

    $album = mysqli_query($banco,"SELECT *FROM `tb_album` WHERE `id_album` = '$id_album'");

    $albumInfo = mysqli_fetch_assoc($album);

    echo "$albumInfo[nome_album]";

}
