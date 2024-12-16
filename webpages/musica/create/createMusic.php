<?php

require('../../module/structure/header.php');

createHeader('Cadastrar música',[
 "../../module/style/element.css",
 "../../module/style/menu.css",
 "../../coletion/style/createColetion.css",
 "../../admin/style/controller.css" ,
]);

?>

<body>

<?php

require('../../module/structure/menu.php');
echo checkProfile();
?>

<section class="elementPage">

<?php

require('../../coletion/module/elementColetion.php');

echo getElementView($banco,"music",false);

?>

<section class="createElementOfColetion">

<form id="musicRegister" class="elementRegister" 
 ectype="multipart-form/data">

<div>

<label class="labelFoto" id="labelForFotoMusica">
    <img src="../../../imgs/website/galeria.png" >
<input type="file" name="fotoMusica" id="fotoMusica">
<p>Insira uma foto para a faixa</p>
</label>


<label class="labelNome">
    <p>Digite o nome da Música:</p> 
<input class="elementName" type="text" name="nomeMusica" id="nomeMusica">
</label>

</div>

<div>

<label class="labelMusic">
Adicionar Áudio<input type="file" name="conteudoMusica" id="conteudoMusica">
</label>


<input type="hidden" name="fk_categoriaMusica" id="fk_categoriaMusica" value="">

<input type="hidden" name="qnt_artista_musica" id="qnt_artista_musica">
<input type="hidden" name="artistas_musica" id="artistas_musica" value="">
<input type="hidden" name="data" id="data" value="">
    
<button onclick="elementChoiceScreen(true,'CreateColetionSinger','CreateMusicSinger')" type="button">
<img src="../../../imgs/website/icons8-usuário-de-gênero-neutro-48 (1).png" alt="">
    Adicionar Artista
</button>

<button onclick="elementChoiceScreen(true,'CreateColetionCategory','CreateMusicCategory')" type="button">
<img src="../../../imgs/website/icons8-música-country-48 (1).png" alt="">

    Adicionar Categoria
</button>
    
<button onclick="
elementRegisterAction(
'MusicRequest',
'create',
'../../musica/create/createMusic.act.php')" 
type="button" class="elementSubmit">
    Cadastrar
</button>


</div>
</form>

</section>

</section>

<script type="module" src="../../coletion/scripts/elementColetion.js"></script>
<script src="../../module/scripts/data.js"></script>

</body>
</html>