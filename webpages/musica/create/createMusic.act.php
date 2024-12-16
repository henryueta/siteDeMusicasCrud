<?php

require('../../../database/connect.php');

extract($_FILES);

extract($_POST);

$response = [];
$msg = "";
$cond = false;
$query = "";

if (!trim(empty($artistas_musica))) {


    if (!empty(trim($artistas_musica))) {
        $artistas_musica = explode(",", $artistas_musica);
    }


    if (!empty(trim($nomeMusica))) {

        if (isset($fotoMusica)) {
            if (isset($conteudoMusica)) {
                if (!empty(trim($fk_categoriaMusica))) {


                    $destinoMusica = "../../../imgs/music/" . md5(time() . $fotoMusica['size']) . ".jpg";

                    $destinoConteudo = "../../musica/source/" . md5(time() . $conteudoMusica['size']) . ".mp3";

                    $musicaRegister = mysqli_query($banco, "INSERT INTO  `tb_musica`
        (`id_musica`,`nome_musica`,`musica`,`qnt_artista`,`foto_musica`,`fk_id_categoria`)
        VALUES(NULL,'$nomeMusica','$destinoConteudo','$qnt_artista','$destinoMusica','$fk_categoriaMusica')");

                    $msg = $msg . $nomeMusica . "\n";
                    $msg = $msg . $destinoConteudo . "\n";
                    $msg = $msg . $destinoMusica . "\n";
                    $msg = $msg . $fk_categoriaMusica . "\n";

                    $musica = mysqli_query($banco, "SELECT *FROM `tb_musica` WHERE `nome_musica` = '$nomeMusica' 
        AND `musica` = '$destinoConteudo' AND `foto_musica` = '$destinoMusica'");

                    $musicas = mysqli_fetch_assoc($musica);

                    $fk_musica = $musicas['id_musica'];

                    foreach ($artistas_musica as $artistaMusica) {
                        mysqli_query($banco, "INSERT INTO `tb_musica_artista`
            (`id_musica_artista`,`fk_id_musica`,`fk_id_artista`)
            VALUES(NULL,'$fk_musica','$artistaMusica')");
                    }


                    if ($musicaRegister) {
                        move_uploaded_file($fotoMusica['tmp_name'], $destinoMusica);
                        move_uploaded_file($conteudoMusica['tmp_name'], $destinoConteudo);
                        $cond = true;
                    }
                } else {
                    $msg = "Campo categoria deve ser preenchido!";
                }
            } else {
                $msg = "Campo música deve ser preenchido!";
            }
        } else {
            $msg = "Campo foto deve ser preenchido!";
        }
    } else {
        $msg = $msg . "Campo nome deve ser preenchido!";
    }

    $music = mysqli_query($banco, "SELECT *FROM `tb_musica`;");


    while ($musics = mysqli_fetch_assoc($music)) {

        $query .= "<div data-value=$musics[id_musica]>

        <img src=$musics[foto_musica]>
        
        <div>
        <p>$musics[nome_musica]</p>
        
        </div>
        
        </div>";
    }
} else {
    $msg = "Campo artista deve ser preenchido!";
}


array_push($response, $cond, $query, $msg);

echo json_encode($response);
