<?php

require('../../../database/connect.php');


extract($_GET);

if(!empty(trim($idMusicList))){

   $idMusicList =  explode(",",$idMusicList);
    
    foreach($idMusicList as $idMusic){

    $deleteMusicPlaylist = mysqli_query($banco,"DELETE FROM `tb_playlist_musica` WHERE `id_playlist_musica` ='$idMusic'");  

    }    
    
    }
    
    
    $album = mysqli_query($banco, "SELECT * FROM `tb_playlist` WHERE `id_playlist`='$idColetion'");
    $playlistInfo = mysqli_fetch_assoc($album);
        echo "<div id=titulo-faixas>
        <h1>Todas as faixas (" . $playlistInfo['qnt_musica'] . ")</h1>
    </div>";

        $queryMusicaPlaylist = mysqli_query($banco, "SELECT * FROM `tb_playlist_musica` WHERE `fk_id_playlist` = '$idColetion'");

        while ($musicaPlaylist = mysqli_fetch_assoc($queryMusicaPlaylist)) {

            $queryMusica = mysqli_query($banco, "SELECT * FROM `tb_musica` WHERE `id_musica` = '$musicaPlaylist[fk_id_musica]'");
            $musica = mysqli_fetch_assoc($queryMusica);

            $queryArtistaTotal = mysqli_query($banco, "SELECT COUNT(*) AS `total` FROM `tb_musica_artista` WHERE `fk_id_musica` = '$musica[id_musica]'");
            $artistaTotal = mysqli_fetch_assoc($queryArtistaTotal);



            $queryArtistaMusica =  mysqli_query($banco, "SELECT *FROM `tb_musica_artista` WHERE `fk_id_musica` = '$musica[id_musica]'");

            $artistas = "";
            $countArtista = 0;
            while ($artistaMusica = mysqli_fetch_assoc($queryArtistaMusica)) {
                $queryArtista = mysqli_query($banco, "SELECT *FROM `tb_artista` WHERE `id_artista` = '$artistaMusica[fk_id_artista]'");
                $artista = mysqli_fetch_assoc($queryArtista);

                $countArtista++;
                if ($artistaTotal['total'] >= 1) {
                    if ($countArtista <= $artistaTotal['total'] - 1) {
                        $artistas = $artistas . $artista['nome_artista'] . " , ";
                    } else {
                        $artistas = $artistas . $artista['nome_artista'];
                    }
                }
            }



            // $queryArtistaAlbum = mysqli_query($banco, "SELECT * FROM `tb_artista` WHERE `id_artista`='$musica[fk_id_artista]'");
            // $artistaAlbum = mysqli_fetch_assoc($queryArtistaAlbum);

            echo "<div class=music-info data-value=$musicaPlaylist[id_playlist_musica]>
            <audio src=$musica[musica]></audio>
            <div class=music-cape>
                <img src=$musica[foto_musica]>
            </div>
            <div class=music-name>
                <h1>$musica[nome_musica]</h1>
                <p>$artistas</p>
            </div>
            
            <div class=music-time>
                <p>3:02</p>
                <img src=../imgs/clock.png alt=>
                <button><img src=../imgs/add.png></button>
            </div>
         </div>";

        }
