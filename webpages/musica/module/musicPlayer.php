


<dialog class="playlistChoiceScreen">
    
<section>

<input class="searchPlaylist" type="search" name="" id="">
    <button id="searchPlaylistBtn">P</button>

</section>

<form>


<?php

extract($_GET);

if(!isset($idPlaylist)){
    $idPlaylist = null;
}

if (isset($_SESSION['logado'])) {
    $playlist = mysqli_query($banco, "SELECT *FROM `tb_playlist` WHERE `fk_id_usuario`='$_SESSION[id]' LIMIT 10");

    } else if (isset($_SESSION['admLogado'])) {
    $playlist = mysqli_query($banco, "SELECT *FROM `tb_playlist` WHERE `fk_id_admin`='$_SESSION[admId]' LIMIT 10");
    }

    while($playlistInfo = mysqli_fetch_assoc($playlist)){     
            if($playlistInfo['id_playlist'] != $idPlaylist){
                echo "<div><input type=checkbox value=$playlistInfo[id_playlist]>$playlistInfo[nome_playlist]</div> ";            
        }
        

    }

?>

</form>

<button class="musicPlaylistSubmit">Pronto</button>

</dialog>

<section class="musicBar">

    <section class="musicBarInfo">

        <img class="musicCapeIcon" src="../../../imgs/website/undefined.png" alt="">


        <div>
            <h1 class="musicTitle">Undefined</h1>
            <p class="musicSinger">undefined</p>

        </div>
        <button>
            <img src="../../../imgs/website/add2.png" alt="" class="musicAddIcon">
        </button>
    </section>


    <section class="musicBarActions">
        <div>
            <input type="range" value="0" class="bar" onclick="setMusicMoment()">
        </div>
        <div>

            <button class="musicBefore" onclick="">
                <img src="../../../imgs/website/skipLeft.png" alt="">
            </button>

            <button onclick="musicAction()">
                <img class="playMusicBtn" src="../../../imgs/website/play2.png" alt="">
            </button>

            <button class="musicAfter" onclick="">
                <img src="../../../imgs/website/skipRight.png" alt="">
            </button>

        </div>
    </section>


    <section class="musicBarInfo">

        <img src="../../../imgs/website/volume.png" alt="" srcset="" class="musicVolumeIcon">

        <div>

            <input type="range" min="0" max="1" value="50%" step="0.1" class="volume">

        </div>
    </section>

</section>


<!-- <script type="module" src="../../musica/scripts/music.js"></script>
<script type="module" src="../../module/scripts/coletion.js"></script> -->

<script type="module">
    


    const musicAddIcon = document.querySelector(".musicAddIcon");
    const playlistChoiceScreen = document.querySelector(".playlistChoiceScreen");

    musicAddIcon.addEventListener('click', () => {

        playlistChoiceScreen.classList.toggle('up');
        musicAddIcon.classList.toggle('add');

        // if(playlistChoiceScreen.classList.contains("openPlaylistChoiceScreen")){
            
        // }

    })
</script>