<?php

require('../../../database/connect.php');

session_start();

extract($_POST);

$fk_admin = 'NULL';
$fk_user = 'NULL';
$playlistView = "";





if(isset($_SESSION['logado'])){
    $fk_user = $_SESSION['id']; 
    $playlist = mysqli_query($banco, "SELECT *FROM `tb_playlist` WHERE `fk_id_usuario`='$_SESSION[id]'");
    $index = mysqli_query($banco, "SELECT COUNT(*) AS `total` FROM `tb_playlist` WHERE `fk_id_usuario`='$_SESSION[id]'");

} else if(isset($_SESSION['admLogado'])){
    $fk_admin = $_SESSION['admId'];
    $playlist = mysqli_query($banco, "SELECT *FROM `tb_playlist` WHERE `fk_id_admin`='$_SESSION[admId]'");
    $index = mysqli_query($banco, "SELECT COUNT(*) AS `total` FROM `tb_playlist` WHERE `fk_id_admin`='$_SESSION[admId]'");
}
$playlistIndex = mysqli_fetch_assoc($index);
    
    
        while ($playlistInfo = mysqli_fetch_assoc($playlist)) {
    
            $playlistView .= "<a href=../../playlist/view/playlist.php?idPlaylist=$playlistInfo[id_playlist]>
        
            <div> 
            
            <img src=../../../imgs/website/playlist.png>
            
            <h1>$playlistInfo[nome_playlist] </h1>
            
            
            </div>
            
            
            </a>";
        }
    
    
    


$nomePlaylist = "Playlist".$playlistIndex['total'] + 1 ;

$playListRegister = mysqli_query($banco,"INSERT INTO `tb_playlist`
(`id_playlist`,`nome_playlist`,`qnt_musica`,`fk_id_usuario`,`fk_id_admin`)
VALUES(NULL,'$nomePlaylist',0,$fk_user,$fk_admin)");



echo $playlistView;
