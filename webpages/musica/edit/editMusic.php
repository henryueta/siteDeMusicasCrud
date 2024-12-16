
<?php

require('../../module/structure/header.php');

createHeader('Editar música',[
    "../../module/style/element.css",
    "../../module/style/menu.css",
    "../../coletion/style/createColetion.css",
    "../../admin/style/controller.css" ,
   ]);

extract($_GET);

require('../../module/structure/menu.php');
echo checkProfile();

$music = mysqli_query($banco,"SELECT *FROM `tb_musica` WHERE `id_musica`='$id_musica'");

$musicInfo = mysqli_fetch_assoc($music);

$music_singer = mysqli_query($banco,"SELECT *FROM `tb_musica_artista` WHERE `fk_id_musica` = '$id_musica'");

$singerList = [];
echo "<script type='module'>

import {singerListConstructor}
from '../../coletion/scripts/elementColetion.js'
let setSingerList = [];
";

while($id_singer = mysqli_fetch_assoc($music_singer)){

array_push($singerList,$id_singer['fk_id_artista']);

echo "
setSingerList.unshift($id_singer[fk_id_artista]);

";

}


 
echo "

singerListConstructor(setSingerList)
</script>";

$singers = implode(",",$singerList);


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

<label class="labelFoto" id="labelForFotoMusica" style='backgroundImage: url("<?php echo $musicInfo['foto_musica'] ?>")'>
    <img src="../../../imgs/website/galeria.png" >
<input type="file" name="fotoMusica" id="fotoMusica">
<p>Insira uma foto para a faixa</p>
</label>
<input type="hidden" name="fotoMusicaAntigo" id="fotoMusicaAntigo" value=<?php echo $musicInfo['foto_musica'] ?>>

<label class="labelNome">
    <p>Digite o nome da Música:</p> 
<input class="elementName" type="text" name="nomeMusica" id="nomeMusica" value="<?php echo $musicInfo['nome_musica'] ?>">
</label>

</div>

<div>

<label class="labelMusic">
Adicionar Áudio<input type="file" name="conteudoMusica" id="conteudoMusica">
</label>
<input type="hidden" name="conteudoMusicaAntigo" id="conteudoMusicaAntigo" value=<?php echo $musicInfo['musica'] ?>>

<input type="hidden" name="id_musica" id="id_musica" value=<?php echo $musicInfo['id_musica'] ?>>

<input type="hidden" name="fk_categoriaMusica" id="fk_categoriaMusica" value="<?php echo $musicInfo['fk_id_categoria'] ?>">

<input type="hidden" name="qnt_artista_musica" id="qnt_artista_musica" value="<?php echo $musicInfo['qnt_artista'] ?>">
<input type="hidden" name="artistas_musica" id="artistas_musica" value="<?php echo $singers ?>">

<button onclick="elementChoiceScreen(true,'CreateColetionSinger','SetMusicSinger')" type="button">
<img src="../../../imgs/website/icons8-usuário-de-gênero-neutro-48 (1).png" alt="">
    Alterar Artista
</button>

<button onclick="elementChoiceScreen(true,'CreateColetionCategory','CreateMusicCategory')" type="button">
<img src="../../../imgs/website/icons8-música-country-48 (1).png" alt="">

    Alterar Categoria
</button>
    
<button onclick="elementRegisterAction('MusicRequest','edit','../../musica/edit/editMusic.act.php')" type="button" class="elementSubmit">
    Editar
</button>

<button onclick="deleteColetionElement('../../musica/delete/deleteMusic.act.php?id_musica=',<?php echo $musicInfo['id_musica'] ?>)" type="button">
    Deletar
</button>

</div>
</form>

</section>

</section>

<script type="module" src="../../coletion/scripts/elementColetion.js"></script>


    
</body>
</html>