    
<?php

require('../../module/structure/header.php');

createHeader("Album",[
    "../../admin/style/controller.css",
    "../../coletion/style/coletion.css",
    "../../coletion/style/createColetion.css",
    "../../module/style/element.css",
    "../../module/style/menu.css"
]);


require('../../module/structure/menu.php');
echo checkProfile();


        if(isset($_SESSION['msg'])){
            
            echo "<script>
            
            alert('$_SESSION[msg]')
            
            </script>";

            unset($_SESSION['msg']);
        }


?>
<body>
<section class="elementPage"> 



<?php

extract($_GET);

require('../../coletion/module/elementColetion.php');

echo getElementView($banco,"album",true);


$album = mysqli_query($banco,"SELECT *FROM `tb_album` WHERE  `id_album` = '$id_album'");

$albumInfo = mysqli_fetch_assoc($album);

?>


<form class="albumForm" method="post" enctype="multipart/form-data" action="createAlbum.act.php">

<div>
<label class="labelFoto" id="labelForFotoAlbum">
    <img src="../../../imgs/website/galeria.png" id="baseForFotoAlbum">
<input type="file" name="fotoAlbum" id="fotoAlbum">
<p>Insira uma foto para o álbum</p>
</label>
<label class="labelNome">
    <p>Digite o nome do álbum:</p> 
<input class="elementName" type="text" name="nomeAlbum" value="<?php echo $albumInfo['nome_album'] ?>">
</label>

<input type="hidden" name="fk_categoriaAlbum" id="fk_categoriaAlbum" value="">

<input type="hidden" name="qnt_musica" id="qnt_musica" value="">
<input type="hidden" name="musicas" id="musicas" value="">


<input type="hidden" name="qnt_categoria" id="qnt_categoria" value="">
<input type="hidden" name="categorias" id="categorias" value="">

<input type="hidden" name="qnt_artista_album" id="qnt_artista_album">
<input type="hidden" name="artistas" id="artistas" value="">
<input type="hidden" name="data" id="data">

</div>
<div>

<button type="button" onclick = "elementChoiceScreen(true,'CreateColetionSinger','CreateAlbumSinger')">
    <img src="../../../imgs/website/icons8-usuário-de-gênero-neutro-48 (1).png" alt="">
    Adicionar Artista
</button>

<button type="button" onclick = "elementChoiceScreen(true,'CreateColetionMusic','CreateAlbumMusic')">
    <img src="../../../imgs/website/icons8-música-48 (1).png" alt="">
    Adicionar Música
</button>

<button type="button" onclick = "elementChoiceScreen(true,'CreateColetionCategory','CreateAlbumCategory')">
    <img src="../../../imgs/website/icons8-música-country-48 (1).png" alt="">
    Adicionar Categoria
</button>

<input type="submit" value="enviar">
</div>

</section>


<script type="module" src="../../coletion/scripts/elementColetion.js">    
</script>

<script type="module" src="../../module/scripts/data.js"></script>


</body>
</html>