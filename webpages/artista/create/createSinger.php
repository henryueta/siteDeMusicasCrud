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

require('../../module/structure/menu.php');


echo checkProfile();

?>
<section class="elementPage">

<section class="createElementOfColetion">

<form id="singerRegister" class="elementRegister">
    
    <label class="labelFoto" id="labelForFotoArtista">
        <p> <input type="file" name="fotoArtista" id="fotoArtista"></p>
    </label>
    <p><input class="elementName" type="text" name="nomeArtista" id="nomeArtista" placeholder="Nome:"></p>
    <input type="hidden" name="data" id="data" value="">

    <button onclick="elementRegisterAction('SingerRequest','create','../../artista/create/createSinger.act.php')" type="button" class="elementSubmit">Cadastrar</button>

</form>

</section>
</section>



<script type="module" src="../../coletion/scripts/elementColetion.js"></script>

<script src="../../module/scripts/data.js"></script>


</body>
</html>