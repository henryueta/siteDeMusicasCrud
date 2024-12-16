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
    <!-- Verificar album, usuarios e adms -->

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

            <button><a href="../../user/create/createUser.php">Cadastrar Usuários</a></button>

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
                        <th><b>E-mail</b></th>
                    </tr>
                    <?php
                    $usuario = mysqli_query($banco, "SELECT *FROM `tb_usuario` LIMIT 10");
                    while ($usuarios = mysqli_fetch_assoc($usuario)) {
                        echo "<tr>
                    <td>$usuarios[id_usuario]</td>
                    <td>$usuarios[nome_usuario]</td>
                    <td>$usuarios[email_usuario]</td>
                    <td>
                    <button><a href=../../user/edit/editUser.php?id_usuario=$usuarios[id_usuario]>Editar</a></button>
                    <button onclick='deleteElementConfirm($usuarios[id_usuario],`$usuarios[nome_usuario]`)'>Deletar</button>
                    </td>
                    </tr>
                    
                    ";

                    
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

echo createDataDelete('tb_usuario','../../user/delete/deleteUser.act.php?id_usuario=');

?>

</body>

</html>