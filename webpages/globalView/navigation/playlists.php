<?php

require('../../module/structure/header.php');


createHeader("Suas playlists", [
    "../../module/style/element.css",
    "../../module/style/menu.css",
    "../../musica/style/musicPlayer.css",
    "../../globalView/style/playlists.css",
    '../../globalView/style/explorer.css'
]);

require('../../module/structure/menu.php');



?>

<section class="atrationPage">

        <div class="searchElement">
            <input type="search" placeholder="O que vamos escutar hoje?">
            <button></button>
            
        </div>
        
    <div class="createPlaylist">

    <button class=playlistSubmit>Criar Playlist</button>
    </div>

    </section>

<section class="listPage">
    <section class="playlist-num">
<input type="hidden" name="data" id="data">


<?php


if (isset($_SESSION['logado'])) {
    $playlist = mysqli_query($banco, "SELECT *FROM `tb_playlist` WHERE `fk_id_usuario`='$_SESSION[id]' LIMIT 10 ");
} else if (isset($_SESSION['admLogado'])) {
    $playlist = mysqli_query($banco, "SELECT *FROM `tb_playlist` WHERE `fk_id_admin`='$_SESSION[admId]' LIMIT 10 ");
}


while ($playlistInfo = mysqli_fetch_assoc($playlist)) {

    echo "<a href=../../playlist/view/playlist.php?idPlaylist=$playlistInfo[id_playlist]>

    <div> 
    
    <img src=../../../imgs/website/playlist.png>
    
    <h1>$playlistInfo[nome_playlist] </h1>
    
    
    </div>
    
    
    </a>";
}

?>


</section>
</section>

<?php

require('../../musica/module/musicPlayer.php');


?>


<script src="../../module/scripts/data.js"></script>

<script type="module">
import {playlistColetion}
 from "../../module/scripts/group.js"; 
const playlistSubmit = document.querySelector(".playlistSubmit");
playlistSubmit.addEventListener('click', () => {
    playlistColetion(null,"CreatePlaylist");
})


</script>


