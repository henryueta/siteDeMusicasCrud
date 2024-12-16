<?php

require('../../../database/connect.php');

extract($_GET);

if ($type == "tb_artista") {


    $singer = mysqli_query($banco, "SELECT *FROM `tb_artista` WHERE `nome_artista` LIKE '$text%'");

    while ($singers = mysqli_fetch_assoc($singer)) {
        echo "<div data-value=$singers[id_artista]>

        <img src=$singers[foto_artista]>

        <div>
            <p>$singers[nome_artista]</p>
        </div>

    </div>";
    }
} else if ($type == "tb_musica") {

    $music = mysqli_query($banco, "SELECT *FROM `tb_musica` WHERE `nome_musica` LIKE '$text%'");

    while ($musics = mysqli_fetch_assoc($music)) {

        echo "<div data-value=$musics[id_musica]>";

        echo"<img src=$musics[foto_musica]>

        <div>   
            <p>$musics[nome_musica]</p>
        </div>

    </div>";
    }
} else if ($type == "tb_categoria") {

    $category = mysqli_query($banco, "SELECT *FROM `tb_categoria` WHERE `nome_categoria` LIKE '$text%'");


    while ($categories = mysqli_fetch_assoc($category)) {

        echo "<div data-value=$categories[id_categoria]>

$categories[nome_categoria]

</div>";
    }
} else if( $type == "Playlist"){

    $playlist = mysqli_query($banco, "SELECT *FROM `tb_playlist` WHERE `nome_playlist` LIKE '$text%'");

    while ($playlists = mysqli_fetch_assoc($playlist)) {

        echo "<div><input type=checkbox value=$playlists[id_playlist]>$playlists[nome_playlist]</div> ";    

    }

} else if($type == "tb_album"){

    $album = mysqli_query($banco,"SELECT *FROM `tb_album` WHERE `nome_album` LIKE '$text%'");

    while($albuns = mysqli_fetch_assoc($album)){
    
        echo "<div data-value=$albuns[id_album]>
    
    <img src=$albuns[foto_album]>
    
        <p>$albuns[nome_album]</p>
        
        </div>";
    
    }

}
