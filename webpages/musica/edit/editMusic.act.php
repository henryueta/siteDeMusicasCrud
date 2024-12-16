<?php

require('../../../database/connect.php');

require('../../module/action/editElementRelation.php');

require('../../module/action/files.php');

extract($_FILES);

extract($_POST);

$response = [];
$msg = "";
$cond = false;
$query = "";
if(isset($artistas_musica)){
    if (!empty(trim($artistas_musica))) {

// if(!empty(trim($artistas_musica))){
//     $artistas_musica = explode(",",$artistas_musica);   
// }


    if(!empty(trim($nomeMusica))){
        if(isset($fotoMusica)){
        $destinoMusica = editElementFile($fotoMusica,$fotoMusicaAntigo,".jpg","../../../imgs/music/");
    } else {
        $destinoMusica = $fotoMusicaAntigo;
    }

    if(isset($conteudoMusica)){
        $destinoConteudo = editElementFile($conteudoMusica,$conteudoMusicaAntigo,".mp3","../../musica/source/");
    } else{
        $destinoConteudo = $conteudoMusicaAntigo;
    }

        
            $musicaRegister = mysqli_query($banco, "UPDATE `tb_musica` SET
            `nome_musica` = '$nomeMusica',
            `musica` ='$destinoConteudo',
            `qnt_artista`='$qnt_artista',
            `foto_musica`='$destinoMusica',
            `fk_id_categoria`='$fk_categoriaMusica'
            WHERE `id_musica` = '$id_musica';
        ");
        
        $msg = $msg . $nomeMusica . "\n";
        $msg = $msg . $destinoConteudo . "\n";
        $msg = $msg . $destinoMusica . "\n";
        $msg = $msg . $fk_categoriaMusica . "\n";

        $musica = mysqli_query($banco,"SELECT *FROM `tb_musica` WHERE `id_musica`='$id_musica'");

        $musicas = mysqli_fetch_assoc($musica);

        $fk_musica = $musicas['id_musica'];

        
        editElementRelation($banco,$artistas_musica,"fk_id_artista","tb_musica_artista","fk_id_musica",$id_musica,true); 
        


if ($musicaRegister) {

    $cond = true;
} else{
    // $msg = $banco->error;
}
    } else{
        // $msg = $msg . "Campo nome precisa ser preenchido!";
    }

} else{
    $msg = "Campo artistas precisa ser preenchido!";
}

    $music = mysqli_query($banco, "SELECT *FROM `tb_musica`;");


    while ($musics = mysqli_fetch_assoc($music)) {

        $query = $query ."<div data-value=$musics[id_musica]>

        <img src=$musics[foto_musica]>
        
        <div>
        <p>$musics[nome_musica]</p>
        
        </div>
        
        </div>";
    }  




array_push($response,$cond,$query,$msg);

echo json_encode($response);
}