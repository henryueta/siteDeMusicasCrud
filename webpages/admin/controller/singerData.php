<?php

require('../../module/structure/header.php');

createHeader("controller",[
    "../style/controller.css",
    "../../module/style/menu.css",
    "../../module/style/element.css"
]);

?>

<body>

<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.6/dist/chart.umd.min.js"></script>


    <!-- Cadastrar album e administrador -->
    <!-- Verificar album, artistas e adms -->

    <?php


    include('../../module/structure/menuController.php');



    ?>

    <section class="elementPage">

        <!-- <h1>Painel de Controle</h1> -->

        <?php

    require('../../module/structure/dataOptions.php');

    ?>

        <section class="elementsGraphic">

            <div>

                <canvas id="userGraphic" style="width:500px;height:300px;border-radius:10px;padding:10px;">
                </canvas>

                <div>
                    
                </div>

            </div>


            <div>

            <button><a href="../../artista/create/createSinger.php">Cadastrar Artista</a></button>

            </div>

            <script type="module" src="../../module/scripts/graphic.js"></script>

        </section>

        <section class="elementsList" id="usersList">


            <section class="elementsTable">

                <div>

                <h1>Tabela de Registros</h1>

                <div>
                <input type="search" name="text" >
                <button>P</button>
                </div>
                
                </div>

                <table>
                    <tr class="tableTitle">
                        <th>Id</th>
                        <th><b>Nome</b></th>
                    </tr>
                    <?php
                    $artista = mysqli_query($banco, "SELECT *FROM `tb_artista` LIMIT 10");
                    while ($artistas = mysqli_fetch_assoc($artista)) {
                        echo "<tr>
                    <td>$artistas[id_artista]</td>
                    <td>$artistas[nome_artista]</td>
                    <td>
                    <button><a href=../../artista/edit/editSinger.php?id_artista=$artistas[id_artista]&&redirect=true>Editar</a></button>
                    <button onclick='deleteElementConfirm($artistas[id_artista],`$artistas[nome_artista]`)'>Deletar</button>
                    </td>
                    </tr>";
                    }
                    ?>
                </table>
            </section>

        </section>

        <a href="../../album/create/createAlbum.php">Album</a>

        <?php

        if ($_SESSION['admTipo'] == "master") {

            echo "<a href=../../admin/createAdmin.php>Admin</a>";
        }


        ?>

    </section>

    <?php

require('../../admin/module/deleteData.php');

echo createDataDelete('tb_artista','../../artista/delete/deleteSinger.act.php?id_artista=');

?>

</body>

</html>