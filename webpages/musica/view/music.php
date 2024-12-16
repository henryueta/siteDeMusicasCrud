<?php

require('../../module/structure/header.php');

createHeader("Artista", [
    "../../module/style/element.css",
    "../../module/style/menu.css",
    "../../musica/style/music.css",
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
    
<section class="musicPage">

<?php
        $music = mysqli_query($banco, "SELECT *FROM `tb_musica` WHERE `id_musica`='$id_musica'");
        $musicInfoMain = mysqli_fetch_assoc($music);

        if (isset($_SESSION['admLogado'])) {
            $add = "<div class=element-add>
        <button>Adicionar artista</button>
        </div>";
            $button = "<button class=editElement>Editar</button>";
            $image =  "
        <input type=file name=fotoMusica id=fotoMusica> 
        <input type=hidden name=fotoMusicaAntigo id=fotoMusicaAntigo value='$musicInfoMain[foto_musica]'>;
        <input type=hidden name=id_musica id=id_musica value='$musicInfoMain[id_musica]'>
        <input type=file name=conteudoMusica id=conteudoMusica>
        <input type=hidden name=conteudoMusicaAntigo id=conteudoMusicaAntigo>
        ";
    
        } else {
            $add = null;
            $button = null;
        }

        $category = mysqli_query($banco,"SELECT *FROM `tb_categoria` WHERE `id_categoria`= '$musicInfoMain[fk_id_categoria]'");
        $categoryInfo = mysqli_fetch_assoc($category);

        echo "

<section class=backAlbum style=background-image:url($musicInfoMain[foto_musica]);>
<div class=album-info>
    <div class=album-cape>            
        </div>";

        echo "<div class=element-name>
            <h1>$musicInfoMain[nome_musica]</h1>
            <p>$categoryInfo[nome_categoria]</p>

            ";


        echo "<div>";
        echo $image;
        echo $button;
        "</div>
       </section>";


        $musicAlbum = mysqli_query($banco, "SELECT *FROM `tb_album_musica` WHERE `fk_id_musica`= '$id_musica'");
        $singerMusic = mysqli_query($banco, "SELECT *FROM `tb_musica_artista` WHERE `fk_id_musica`= '$id_musica'");




        ?>



    </section>


    <?php



    require('../../coletion/module/elementColetion.php');

    echo getElementView($banco, "music", false);

    ?>

    <?php
    $singerView = null;
    echo "<script type='module'>
    import {singerMusicConstructor,musicAlbumConstructor} from '../../coletion/scripts/elementColetion.js';
    let setSingerMusicList = []
    let setMusicAlbumList = []";
    while ($singerMusicInfo = mysqli_fetch_assoc($singerMusic)) {
        $singer = mysqli_query($banco, "SELECT *FROM `tb_artista` WHERE `id_artista`='$singerMusicInfo[fk_id_artista]'");
        $singerInfo = mysqli_fetch_assoc($singer);

        $singerView .= "<div>
        <img src=$singerInfo[foto_artista]>
        <p>$singerInfo[nome_artista]</p>
        </div>";

        echo "
        
        setSingerMusicList.unshift('$singerMusicInfo[fk_id_musica]');";
    }

    $albumView = null;
    while ($musicAlbumInfo = mysqli_fetch_assoc($musicAlbum)) {
        $album = mysqli_query($banco, "SELECT *FROM `tb_album` WHERE `id_album`='$musicAlbumInfo[fk_id_album]'");
        $albumInfo = mysqli_fetch_assoc($album);
        $albumView .= "<div>
    <img src=$albumInfo[foto_album]>
    <p>$albumInfo[nome_album]</p>
    </div>";


    echo "
        
        setMusicAlbumList.unshift('$musicAlbumInfo[fk_id_album]');";
    }



    echo "singerMusicConstructor(setSingerMusicList)
        musicAlbumConstructor(setMusicAlbumList)
        </script>";

    echo $add;
    ?>


    <section class="singer-num">


        <?php


        echo $singerView;

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