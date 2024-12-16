<?php
require('../../../database/connect.php');

session_start();
require('../../module/action/verify.php');


?>

<nav class="navBar" id="navBarCommon">

    <div>


        <h1>
            <a href="../../globalView/navigation/explorer.php"><span>Hypp!</span>Music</a>
        </h1>
    </div>


    <ul>

        <li><a href="../../globalView/navigation/explorer.php"><img src="../../../imgs/website/compass.png"><span>Explorar</span></a></li>


        <li><a href="../../globalView/navigation/playlists.php"><img src="../../../imgs/website/playlist.png" alt=""><span>Playlists</span></a></li>

        <?php
        if (isset($_SESSION['admLogado'])) {
            if ($_SESSION['admTipo']) {
                echo "<li><a href=../../admin/controller/controller.php><img src=../../../imgs/website/settings.png><span>Controller</span></a></li>";
            }
        }


        ?>


        <li><a href="../../module/action/logout.php"><img src="../../../imgs/website/logout.png"><span>Sair</span></a></li>

    </ul>

</nav>


<!-- <section class="playlistPage">

<dialog open>


</dialog>

</section> -->

<script src="../../../libs/jquery-3.7.1.min"></script>
