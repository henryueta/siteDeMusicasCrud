
<?php

require('../../module/structure/header.php');

createHeader("Album",[
    "../../coletion/style/coletion.css",
    "../../coletion/style/createColetion.css",
    "../../module/style/element.css",
    "../../musica/style/musicPlayer.css",
    "../../module/style/menu.css"
]);

?>

<body>

    <?php




    include('../../module/structure/menu.php');

    include('../../musica/module/musicPlayer.php');

    



    ?>

    <?php
    extract($_GET);

    $album = mysqli_query($banco, "SELECT * FROM `tb_playlist` WHERE `id_playlist`='$idPlaylist'");
    $playlistInfo = mysqli_fetch_assoc($album);
    $musicView = "";
    
    if (isset($_SESSION['logado'])) {
        $pessoa = mysqli_query($banco, "SELECT *FROM `tb_usuario` WHERE `id_usuario`='$_SESSION[id]' LIMIT 10");
        $nome = "nome_usuario";
        $id = $_SESSION['id'];
    } else if (isset($_SESSION['admLogado'])) {
        $pessoa = mysqli_query($banco, "SELECT *FROM `tb_admin` WHERE `id_admin`='$_SESSION[admId]' LIMIT 10");
        $nome = "nome_admin";
        $id = $_SESSION['admId'];
    }

    if($id != $playlistInfo['fk_id_admin'] || $playlistInfo['fk_id_usuario']){
        header("location:../main/error.php");
    }



    $pessoaInfo = mysqli_fetch_assoc($pessoa);

    echo "<section class=albumPage>

<section class=backAlbum style=background-color:rgb(25, 25, 26);>

    <div class=album-info>
    <div class=album-cape>
            <img id=playlistImage src=../../../imgs/website/playlist.png alt=>
        </div>
        <div class=coletion-name>
            <h1>$playlistInfo[nome_playlist]</h1>

            <p>$pessoaInfo[$nome]</p>

            <div>
            <button class=startAlbum onclick=toggleElement('.startAlbum','ativo')>
                <img class=play-icon src=../imgs/website/play.png alt=>
                Play Album
            </button>

            <button class=editColetion>Editar</button>
            

            </div>

        </div>";

    ?>

    </div>
    </section>

    <dialog class="playlistEditScreen">

        <form>

            <div class=music-edit>
                <p id="musicCount">(0)</p>
                <button type="button" value=<?php echo $idPlaylist ?>>Deletar</button>
            </div>

        </form>


    </dialog>

    <section class="music-num">
        <?php

        echo "<div id=titulo-faixas>
    <h1>Todas as faixas (" . $playlistInfo['qnt_musica'] . ")</h1>
</div>";



        $queryMusicaPlaylist = mysqli_query($banco, "SELECT * FROM `tb_playlist_musica` WHERE `fk_id_playlist` = '$idPlaylist'");

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
            $musicView .= "<div class=music-info data-value=$musicaPlaylist[id_playlist_musica]>
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
                <img src=../../../imgs/website/clock.png alt=>
                <button><img src=../../../imgs/website/add.png></button>
            </div>
         </div>";


            // $queryArtistaAlbum = mysqli_query($banco, "SELECT * FROM `tb_artista` WHERE `id_artista`='$musica[fk_id_artista]'");
            // $artistaAlbum = mysqli_fetch_assoc($queryArtistaAlbum);

            
        }

        echo $musicView;

        ?>




    </section>

    </section>

    <?php

    include('../../module/structure/footer.php');

    require('../../coletion/module/editElementColetion.php');



    ?>

    
</body>

</html>