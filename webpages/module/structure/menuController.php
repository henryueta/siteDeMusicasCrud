<?php
require('../../../database/connect.php');

session_start();
require('../../module/action/verify.php');
    
echo checkProfile();
?>

<nav class="navBar" id="navBarAdmin">

    <div>

        <!-- <div class="closeNav">
    <div></div>
    <div></div>
</div> -->

        <h1>
            <a href="../../globalView/navigation/explorer.php"><span>Hypp!</span>Admin</a>
        </h1>
    </div>


    <ul>

        <li><a href="../../view/explorer.php"><span>Resumo </span></a></li>

        <!-- <li ><a href="../../admin/controller/userData.php"><span>Usuário</span></a></li>
        
        <li ><a href="../../view/explorer.php"><span>Admin</span></a></li>

        <li ><a href="../../view/explorer.php"><span>Música</span></a></li>
        <li ><a href="../../view/explorer.php"><span>Playlist</span></a></li>
        <li ><a href="../../view/explorer.php"><span>Álbum</span></a></li>
        <li ><a href="../../view/explorer.php"><span>Artista</span></a></li>
        <li ><a href="../../view/explorer.php"><span>Categoria</span></a></li> -->

    </ul>

</nav>


<!-- <section class="playlistPage">

<dialog open>


</dialog>

</section> -->

<script src="../../../libs/jquery-3.7.1.min"></script>


<script type="module">
    import {
        playlistColetion
    } from "../../coletion/scripts/coletion";

    <?php

    $index = mysqli_query($banco, "SELECT COUNT(*) AS `total` FROM `tb_playlist`");
    $playlistIndex = mysqli_fetch_assoc($index);

    ?>
    let index = <?php echo $playlistIndex['total'] + 1 ?>;
    const playlistSubmit = document.querySelector(".playlistSubmit");

    playlistSubmit.addEventListener('click', () => {

        playlistColetion(index,"CreatePlaylist");

})




</script>