<?php

require('../../../database/connect.php');

extract($_GET);

// $deleteMusicAlbum = mysqli_query($banco,"DELETE FROM `tb_album_musica` WHERE `fk_id_musica`='$id_musica'");

// $deleteMusicSinger = mysqli_query($banco,"DELETE FROM `tb_musica_artista` WHERE `fk_id_musica`='$id_musica'");

mysqli_query($banco,"DELETE FROM `tb_musica` WHERE `id_musica`='$id_musica'");

header('location:../../admin/controller/musicData.php');