<?php

extract($_POST);
extract($_FILES);

require('../../../database/connect.php');
require('../../module/action/files.php');

$response = [];
$msg = "";
$cond = false;
$query = "";
$destinoArtista = null;

if (!empty(trim($nomeArtista))) {   
    if (isset($fotoArtista)) {
        $destinoArtista = editElementFile($fotoArtista,$fotoArtistaAntigo,".jpg","../../../imgs/singer/");
    } else {
        $destinoArtista = $fotoArtistaAntigo;
    }
    
        
        $artistaRegister = mysqli_query($banco, "UPDATE  `tb_artista` SET
        `nome_artista`='$nomeArtista',
        `foto_artista`='$destinoArtista'
        WHERE `id_artista`='$id_artista';");

if ($artistaRegister) {
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
    $msg = "campo nome deve ser preenchido!";
}


array_push($response,$cond,$query,$msg);

echo json_encode($response);


