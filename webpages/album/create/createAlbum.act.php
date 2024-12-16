<?php

require('../../../database/connect.php');


extract($_POST);

extract($_FILES);

session_start();

$msg = "";

if (!empty(trim($musicas))) {

    $musicas = explode(",", $musicas);

    if (!empty(trim($categorias))) {

        $categorias = explode(",", $categorias);

        if (!empty(trim($artistas))) {

            $artistas = explode(",", $artistas);
            if (sizeof($musicas) > 0 && sizeof($artistas) > 0 && sizeof($categorias) > 0 && $fotoAlbum['size'] > 0 && !empty(trim($nomeAlbum))) {
                $destinoAlbum = "../../../imgs/album/" . md5(time() . $fotoAlbum['size']) . ".jpg";
            
                $albumRegister = mysqli_query(
                    $banco,
                    "INSERT INTO `tb_album`(`id_album`,`nome_album`,`qnt_musica`,`qnt_categoria`,`qnt_artista`,`foto_album`) 
                    VALUES(NULL,'$nomeAlbum','$qnt_musica','$qnt_categoria','$qnt_artista_album','$destinoAlbum')"
                );
            
                if ($albumRegister) {
                    move_uploaded_file($fotoAlbum['tmp_name'], $destinoAlbum);
                    $msg = "Album cadastrado!";
                }
            
                $album = mysqli_query($banco, "SELECT *FROM `tb_album` WHERE `nome_album` = '$nomeAlbum' AND `foto_album` = '$destinoAlbum'
                    AND `qnt_artista` = '$qnt_artista_album';");
            
                $albuns = mysqli_fetch_assoc($album);
            
                $fk_album = $albuns['id_album'];
            
            
                foreach ($musicas as $musicaAlbum) {
            
                    // $total = mysqli_query($banco,"SELECT COUNT(*) AS `total` FROM `tb_album_musica` WHERE `fk_id_album`='$musicaAlbum'");
            
                    // if($total -> num_rows == 1){
                    //     $number = mysqli_fetch_assoc($total);
                    //     $count = $number['total'];
                    // }
            
                    // $count++;
            
                    mysqli_query($banco, "INSERT INTO `tb_album_musica`
                        (`id_album_musica`,`fk_id_musica`,`fk_id_album`)
                        VALUES(NULL,'$musicaAlbum','$fk_album')");
                }
            
                foreach ($categorias as $categoriaAlbum) {
                    mysqli_query($banco, "INSERT INTO `tb_album_categoria`
                        (`id_album_categoria`,`fk_id_categoria`,`fk_id_album`)
                        VALUES(NULL,'$categoriaAlbum','$fk_album')");
                }
            
                foreach ($artistas as $artistaAlbum) {
                    mysqli_query($banco, "INSERT INTO `tb_album_artista`
                        (`id_album_artista`,`fk_id_artista`,`fk_id_album`)
                        VALUES(NULL,'$artistaAlbum','$fk_album')");
                }
            } else if (sizeof($musicas) == 0) {
                $msg = "Nenhuma musica selecionada!";
            } else if (sizeof($categorias) == 0) {
                $msg = "Nenhuma categoria selecionada!";
            } else if (sizeof($artistas) == 0) {
                $msg = "Nenhum artista selecionado!";
            } else if ($fotoAlbum['size'] == 0) {
                $msg = "Nenhuma capa selecionada!";
            } else if (empty(trim($nomeAlbum))) {
                $msg = "Nenhum nome definido!";
            }
        } else{
            $msg = "Campo artistas deve ser preenchido!";
        }
    } else{
        $msg = "Campo categorias deve ser preenchido!";
    }
} else{
    $msg = "Campo músicas deve ser preenchido!";
}








$_SESSION['msg'] = $msg;

header('location: createAlbum.php');
