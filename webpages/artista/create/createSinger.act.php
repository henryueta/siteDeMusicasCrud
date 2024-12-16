<?php

require('../../../database/connect.php');


extract($_FILES);

extract($_POST);

$response = [];
        $msg = "";
        $cond = false;
        $query = "";

if (!empty(trim($nomeArtista))) {
    if (isset($fotoArtista)) {

        

        $destinoArtista = "../../../imgs/singer/" . md5(time() . $fotoArtista['size']) . ".jpg";

        $artistaRegister = mysqli_query($banco, "INSERT INTO  `tb_artista`
    (`id_artista`,`nome_artista`,`foto_artista`,`qnt_albuns`,`data_registro`)
    VALUES(NULL,'$nomeArtista','$destinoArtista',0,'$data')");

if ($artistaRegister) {
    move_uploaded_file($fotoArtista['tmp_name'],$destinoArtista);
    $singer = mysqli_query($banco, "SELECT *FROM `tb_artista`;");
    $cond = true;


    while ($singers = mysqli_fetch_assoc($singer)) {

        $query .= "<div data-value=$singers[id_artista]>

<img src=$singers[foto_artista]>

<div>
<p>$singers[nome_artista]</p>
</div>

</div>";
    }

}

    } else {
        $msg = "campo foto deve ser preenchido!";
    }
} else {
    $msg = "campo nome deve ser preenchido!";
}


array_push($response,$cond,$query,$msg);

echo json_encode($response);

