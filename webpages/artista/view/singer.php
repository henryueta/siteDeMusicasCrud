<?php

require('../../module/structure/header.php');

createHeader("Artista", [
    "../../module/style/element.css",
    "../../module/style/menu.css",
    "../../artista/style/singer.css",
    "../../coletion/style/createColetion.css",
    "../../musica/style/musicPlayer.css"
]);

?>

<body>

    <?php

    require('../../module/structure/menu.php');

    include('../../musica/module/musicPlayer.php');


    extract($_GET);

    ?>



    <section class="singerPage">



        <?php
        $singer = mysqli_query($banco, "SELECT *FROM `tb_artista` WHERE `id_artista`='$id_artista'");
        $singerInfoMain = mysqli_fetch_assoc($singer);

        if (isset($_SESSION['admLogado'])) {
            $add = "<div class=element-add>
        <button>Adicionar faixa de música</button>
        </div>";
            $button = "<button class=editElement>Editar</button>";
            $image =  "
        <input type=file name=fotoArtista id=fotoArtista>
        <input type=hidden name=fotoArtistaAntigo id=fotoArtistaAntigo value='$singerInfoMain[foto_artista]'>;
        <input type=hidden name=id_artista id=id_artista value='$singerInfoMain[id_artista]'>";
        } else {
            $add = null;
            $button = null;
        }


        echo "

<section class=backSinger style=background-image:url($singerInfoMain[foto_artista]);>
<div class=album-info>
    <div class=album-cape>            
        </div>";

        echo "<div class=element-name>
            <h1>$singerInfoMain[nome_artista]</h1>
            ";


        echo "<div>";
        echo $image;
        echo $button;
        "</div>
       </section>";


        $singerAlbum = mysqli_query($banco, "SELECT *FROM `tb_album_artista` WHERE `fk_id_artista`= '$id_artista'");
        $singerMusic = mysqli_query($banco, "SELECT *FROM `tb_musica_artista` WHERE `fk_id_artista`= '$id_artista'");




        ?>



    </section>


    <?php



    require('../../coletion/module/elementColetion.php');

    echo getElementView($banco, "singer", false);

    ?>

    <?php
    $musicView = null;
    echo "<script type='module'>
    import {singerMusicConstructor,singerAlbumConstructor} from '../../coletion/scripts/elementColetion.js';
    let setSingerMusicList = []
    let setSingerAlbumList = []";
    while ($singerMusicInfo = mysqli_fetch_assoc($singerMusic)) {
        $music = mysqli_query($banco, "SELECT *FROM `tb_musica` WHERE `id_musica`='$singerMusicInfo[fk_id_musica]'");
        $musicInfo = mysqli_fetch_assoc($music);

        $musicView .= "<div>
        $musicInfo[nome_musica]
        </div>";

        echo "
        
        setSingerMusicList.unshift('$singerMusicInfo[fk_id_musica]');";
    }

    $albumView = null;
    while ($singerAlbumInfo = mysqli_fetch_assoc($singerAlbum)) {
        $album = mysqli_query($banco, "SELECT *FROM `tb_album` WHERE `id_album`='$singerAlbumInfo[fk_id_album]'");
        $albumInfo = mysqli_fetch_assoc($album);
        $albumView .= "<div>
    <img src=$albumInfo[foto_album]>
    <p>$albumInfo[nome_album]</p>
    </div>";


    echo "
        
        setSingerAlbumList.unshift('$singerAlbumInfo[fk_id_album]');";
    }



    echo "singerMusicConstructor(setSingerMusicList)
        singerAlbumConstructor(setSingerAlbumList)
        </script>";

    echo $add;
    ?>


    <section class="music-num">


        <?php


        echo $musicView;

        ?>

    </section>

    <section class="singerAlbum">

        <article>
            <h1>Álbuns</h1>
        </article>

        <section class="album-num">

            <?php

            echo "<div class=album-add>

<button > 
Adicionar Álbum
</button>

</div>";



            echo $albumView;

            ?>

        </section>

    </section>



    <?php

    require('../../coletion/module/editElement.php');

    ?>


</body>

</html>