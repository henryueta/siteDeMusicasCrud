<?php

require('../../module/structure/header.php');

createHeader("controller", [
    "../style/controller.css",
    "../../module/style/menu.css",
    "../../module/style/element.css"
]);

?>

<body>

    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.6/dist/chart.umd.min.js"></script>


    <!-- Cadastrar album e administrador -->
    <!-- Verificar album, categorias e adms -->

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

                <button><a href="../../categoria/create/createSinger.php">Cadastrar categoria</a></button>

            </div>

            <script type="module" src="../../module/scripts/graphic.js"></script>

        </section>

        <section class="elementsList" id="usersList">


            <section class="elementsTable">

                <div>

                    <h1>Tabela de Registros</h1>

                    <div>
                        <input type="search" name="text">
                        <button>P</button>
                    </div>

                </div>

                <table>
                    <tr class="tableTitle">
                        <th>Id</th>
                        <th><b>Nome</b></th>
                    </tr>
                    <?php
                    $categoria = mysqli_query($banco, "SELECT *FROM `tb_categoria` LIMIT 10");
                    while ($categorias = mysqli_fetch_assoc($categoria)) {
                        echo "<tr>
                    <td>$categorias[id_categoria]</td>
                    <td>$categorias[nome_categoria]</td>
                    <td>
                    <button onclick='deleteElementConfirm($categorias[id_categoria],`$categorias[nome_categoria]`)'>Deletar</button>
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

    echo createDataDelete('tb_categoria', '../../categoria/delete/deleteCategory.act.php?id_categoria=');

    ?>

</body>

</html>