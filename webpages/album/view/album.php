<?php

require('../../module/structure/header.php');

createHeader("Album",[
    "../../coletion/style/coletion.css",
    "../../coletion/style/createColetion.css",
    "../../module/style/element.css",
    "../../musica/style/musicPlayer.css",
    "../../module/style/menu.css",
]);

?>

<body>
    

<?php

include('../../module/structure/menu.php');

include('../../musica/module/musicPlayer.php');

?>

<?php
    extract($_GET);

    $album = mysqli_query($banco, "SELECT * FROM `tb_album` WHERE `id_album`='$id'");
    $albumInfo = mysqli_fetch_assoc($album);
    $musicaView = "";
    if (isset($_SESSION['admLogado'])) {
    $button = "<button class=editColetion>Editar</button>";
    $edit = "<dialog class=playlistEditScreen>
    <form>

        <div class=music-edit>
            <p id=musicCount>(0)</p>
            <button type=button value= $idPlaylist >Deletar</button>
        </div>

    </form>


</dialog>";
    $add = "<div class=music-add>
    <button>Adicionar faixa de música</button>
    </div>";
    $image = "<label class=labelFoto id=labelForEditAlbum style=background-image:url($albumInfo[foto_album]);>
    <img src=../../../imgs/website/galeria.png >
<input type=file name=fotoAlbumEdit id=fotoAlbumEdit value=$albumInfo[foto_album]>
<p>Insira uma foto para a faixa</p>
</label>";
} else{
    $button = null;
    $edit = null;
}

            $queryArtistaTotal = mysqli_query($banco, "SELECT COUNT(*) AS `total` FROM `tb_album_artista` WHERE `fk_id_album` = '$id'");
            $artistaTotal = mysqli_fetch_assoc($queryArtistaTotal);

            $queryCategoriaTotal = mysqli_query($banco, "SELECT COUNT(*) AS `total` FROM `tb_album_categoria` WHERE `fk_id_album` = '$id'");
            $categoriaTotal = mysqli_fetch_assoc($queryCategoriaTotal);

            $queryArtistaAlbum =  mysqli_query($banco, "SELECT *FROM `tb_album_artista` WHERE `fk_id_album` = '$id'
            ORDER BY `fk_id_artista` ASC");
            $queryCategoriaAlbum = mysqli_query($banco,"SELECT*FROM `tb_album_categoria` WHERE `fk_id_album` = '$id'");

            $artistasDoAlbum = "";
            $categoriasDoAlbum = "";
            $countCategoria = 0;
            $countArtista = 0;
            echo "<script type='module'>
            import {categoryListConstructor,singerListConstructor} from '../../coletion/scripts/elementColetion.js';
            let setSingerList = [];
            let setCategoryList = []";
            while ($artistaAlbum = mysqli_fetch_assoc($queryArtistaAlbum)) {
                $queryArtista = mysqli_query($banco, "SELECT *FROM `tb_artista` WHERE `id_artista` = '$artistaAlbum[fk_id_artista]'");
                $artista = mysqli_fetch_assoc($queryArtista);
                echo "
                setSingerList.unshift('$artista[id_artista]');
                ";
                $countArtista++;
                if ($artistaTotal['total'] >= 1) {
                    if ($countArtista <= $artistaTotal['total'] - 1) {
                        $artistasDoAlbum = $artistasDoAlbum . $artista['nome_artista'] . " , ";
                    } else {
                        $artistasDoAlbum = $artistasDoAlbum . $artista['nome_artista'];
                    }
                }
                
            }
            

            while($categoriaAlbum = mysqli_fetch_assoc($queryCategoriaAlbum)){
                $queryCategoria = mysqli_query($banco, "SELECT *FROM `tb_categoria` WHERE `id_categoria` = '$categoriaAlbum[fk_id_categoria]'");
                $categoria = mysqli_fetch_assoc($queryCategoria);
                echo "
                setCategoryList.unshift('$categoria[id_categoria]');
                ";
                $countCategoria++;
                if ($categoriaTotal['total'] >= 1) {
                    if ($countCategoria <= $categoriaTotal['total'] - 1) {
                        $categoriasDoAlbum = $categoriasDoAlbum . $categoria['nome_categoria'] . " , ";
                    } else {
                        $categoriasDoAlbum = $categoriasDoAlbum . $categoria['nome_categoria'];
                    }
                }

            }
            
            echo "
            singerListConstructor(setSingerList);
            categoryListConstructor(setCategoryList);
            </script>";

    echo "<section class=albumPage>

<section class=backAlbum style=background-image:url($albumInfo[foto_album]);>

    <div class=album-info>
    <div class=album-cape>
    <img id=albumImage src=$albumInfo[foto_album] alt=>
            $image
        </div>";

        echo "<div class=coletion-name>
            <h1>$albumInfo[nome_album]</h1>
            <div class=coletion-category><p>$categoriasDoAlbum</p></button></div>
           <div class=coletion-singer><p>$artistasDoAlbum</p></div>";
            
            if($button != null){
                echo "<div>";
            }

            echo '<button class=startAlbum onclick="toggleElement(.startAlbum,ativo)">
                Play Album
            </button>';

            
            echo $button;
        

       "</div>";

    ?>
<!-- onclick="toggleElement(.startAlbum,ativo)" -->
    </div>
</section>

<?php



echo $add;


require('../../coletion/module/elementColetion.php');

echo getElementView($banco,"album",false);

?>
<?php



$queryAlbumMusica = mysqli_query($banco, "SELECT * FROM `tb_album_musica` WHERE `fk_id_album` = '$id'");
echo "<script type='module'>
import {musicListConstructor,coletionMusicList} from '../../coletion/scripts/elementColetion.js';
let setMusicList = [];
";
while($albumMusica = mysqli_fetch_assoc($queryAlbumMusica)){
    $queryMusica = mysqli_query($banco, "SELECT * FROM `tb_musica` WHERE `id_musica` = '$albumMusica[fk_id_musica]'");
    $musica = mysqli_fetch_assoc($queryMusica);
    
    echo "
    setMusicList.unshift('$musica[id_musica]');";
    $queryArtistaTotal = mysqli_query($banco, "SELECT COUNT(*) AS `total` FROM `tb_musica_artista` WHERE `fk_id_musica` = '$musica[id_musica]'");
            $artistaTotal = mysqli_fetch_assoc($queryArtistaTotal);

            $queryArtistaMusica =  mysqli_query($banco, "SELECT *FROM `tb_musica_artista` WHERE `fk_id_musica` = '$musica[id_musica]'
            ORDER BY `fk_id_artista` ASC");

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

            $musicaView .= "<div class=music-info data-value=$musica[id_musica]>
            <audio src=$musica[musica]></audio>
            <div class=music-cape>
                <img id=albumMusicImage src=$albumInfo[foto_album]>
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
    
}
echo "
musicListConstructor(setMusicList);
</script>";
echo "
<section class=music-num>

<div id=titulo-faixas>
    <h1>Todas as faixas (". $albumInfo['qnt_musica'] .")</h1>
</div>";
echo $musicaView;

?>




</section>

</section>

<script type="module" src="../../coletion/scripts/elementColetion.js"></script>
<script type="module" src="../../musica/scripts/music.js"></script>

<?php

include('../../module/structure/footer.php');



?>



    

<script type="module">





document.querySelector('#btnElementOfColetion').addEventListener('click',()=>{
    elementViewScreen("Visualizar Artista")
})


</script>

<?php
require('../../coletion/module/editElementColetion.php');


?>

</body>
</html>