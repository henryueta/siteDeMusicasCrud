<?php

require('../../module/structure/header.php');

createHeader("Cadastrar Artista",[
    "../../module/style/element.css",
    "../../module/style/menu.css",
    "../../module/style/footer.css",
    "../../musica/style/musicPlayer.css",
    "../../coletion/style/createColetion.css"
]);

?>

<body>
    
<?php
extract($_GET);
require('../../module/structure/menu.php');
echo checkProfile();
    $artista = mysqli_query($banco, "SELECT * FROM `tb_artista` WHERE `id_artista`='$id_artista'");
    $artistaInfo = mysqli_fetch_assoc($artista);
    ?>


    <section class="elementPage">

<section class="createElementOfColetion">

<form id="singerRegister" class="elementRegister">
    
    <label class="labelFoto" id="labelForFotoArtista" style="background-image:url(<?php echo $artistaInfo['foto_artista']?>)">
        <p> <input type="file" name="fotoArtista" id="fotoArtista"></p>
        <input type="hidden" name="fotoArtistaAntigo" id="fotoArtistaAntigo" value="<?php echo $artistaInfo['foto_artista']?>">
        <input type="hidden" name="id_artista" id="id_artista" value="<?php echo $artistaInfo['id_artista']; ?>">
    </label>
    <p><input class="elementName" type="text" name="nomeArtista"
     id="nomeArtista" placeholder="Nome:" value="<?php echo $artistaInfo['nome_artista']?>"></p>

    <button onclick="elementRegisterAction('SingerRequest','edit','../../artista/edit/editSinger.act.php')" type="button" class="elementSubmit">Editar</button>

</form>

</section>
</section>

<script type="module" src="../../coletion/scripts/elementColetion.js"></script>

</body>
</html>

