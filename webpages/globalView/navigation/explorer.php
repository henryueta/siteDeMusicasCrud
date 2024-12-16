<?php

require('../../module/structure/header.php');

createHeader("Home", [
    "../style/explorer.css",
    "../../module/style/element.css",
    "../../module/style/menu.css",
    "../../module/style/footer.css",
    "../../musica/style/musicPlayer.css",
]);

?>

<body>



    <?php

    include('../../module/structure/menu.php');

    include('../../musica/module/musicPlayer.php');

    ?>
    <section class="atrationPage">

        <div class="searchElement">
            <input type="search" class="search" placeholder="O que vamos escutar hoje?">
            <button class="searchId"><img src="../../../imgs/website/search.png"></button>
        </div>
        <script src="module">
            import {searchElement} from "../../coletion/scripts/elementColetion.js";

            

        </script>

    </section>



    <section class="listPage">

        <section class="elementTypeTitle">
            <h1>Músicas</h1>
        </section>

        <article>

            <section class="albumType" id="elemenType">


                <?php
                $teste = 0;

                $queryAlbuns = mysqli_query($banco, "SELECT * FROM `tb_album`");

                while ($album = mysqli_fetch_assoc($queryAlbuns)) {
                    $artistasDoAlbum = "";
                    $countArtista = 0;
                    $queryArtistaTotal = mysqli_query($banco, "SELECT COUNT(*) AS `total` FROM `tb_album_artista` WHERE `fk_id_album` = '$album[id_album]'");
                    $artistaTotal = mysqli_fetch_assoc($queryArtistaTotal);

                    $queryArtistaAlbum =  mysqli_query($banco, "SELECT *FROM `tb_album_artista` WHERE `fk_id_album` = '$album[id_album]'
            ORDER BY `fk_id_artista` ASC");



                    while ($artistaAlbum = mysqli_fetch_assoc($queryArtistaAlbum)) {

                        $queryArtista = mysqli_query($banco, "SELECT *FROM `tb_artista` WHERE `id_artista` = '$artistaAlbum[fk_id_artista]'");
                        $artista = mysqli_fetch_assoc($queryArtista);

                        $countArtista++;
                        if ($artistaTotal['total'] >= 1) {
                            if ($countArtista <= $artistaTotal['total'] - 1) {
                                $artistasDoAlbum = $artistasDoAlbum . $artista['nome_artista'] . " , ";
                            } else {
                                $artistasDoAlbum = $artistasDoAlbum . $artista['nome_artista'];
                            }
                        }
                    }

                    echo "<div>
                    <a href=../../album/view/album.php?id=$album[id_album]>
                    <div>
                        <img src=$album[foto_album]>

                    </div>
                    <h1 class=titulo>$album[nome_album]</h1>
                    <p>$artistasDoAlbum</p>
                    </a>
                </div>";
                }
                ?>

                <!--  -->
            </section>


            <?php



            ?>

        </article>

        <section class="elementTypeTitle">
            <h1>Artistas</h1>
        </section>

        <article>

                
            <section class="singerType" id="elementType">

                <?php

                $queryArtista = mysqli_query($banco, "SELECT *FROM `tb_artista` LIMIT 8");
                while ($artista = mysqli_fetch_assoc($queryArtista)) {

                    
    echo "<div>
    <a href=../../artista/view/singer.php?id_artista=$artista[id_artista]>
    <div>
        <img src=$artista[foto_artista]>

    </div>
    <h1 class=titulo>$artista[nome_artista]</h1>
    </a>
</div>";

                }


                ?>


            </section>

        </article>


    </section>


    <?php

    require('../../module/structure/footer.php');

    ?>


</body>

</html>