<?php

function createElementView($database,$type,$register)
{

    $singerRegister = "";
    $musicRegister = "";
    $categoryRegister = "";
if($register){
    
    $singerRegister = "
    <form id='singerRegister' class='elementRegister'>
    
            <label class='labelFoto' id='labelForFotoArtista'>
                <p> <input type='file' name='fotoArtista' id='fotoArtista'></p>
            </label>
            <p><input class='elementName' type='text' name='nomeArtista' id='nomeArtista' placeholder='Nome:'></p>
    
            <button onclick='elementRegisterAction(`SingerRequest`,`create`,`../../artista/create/createSinger.act.php`)' type='button' class='elementSubmit'>Cadastrar</button>
    
        </form>";

        $cond = 'false';
        if($type == "music"){
            $cond = 'true';
        } else if($type == "album"){
            $cond = 'false';
        }

    $musicRegister = "<form id='musicRegister' class='elementRegister' 
    action='createMusic.act.php' method='post' ectype='multipart-form/data'>
    
    <div>
    
    <label class='labelFoto' id='labelForFotoMusica'>
        <img src='../../../imgs/website/galeria.png' >
    <input type='file' name='fotoMusica' id='fotoMusica'>
    <p>Insira uma foto para a faixa</p>
    </label>
    
    
    <label class='labelNome'>
        <p>Digite o nome da Música:</p> 
    <input class='elementName' type='text' name='nomeMusica' id='nomeMusica'>
    </label>
    
    </div>
    
    <div>
    
    <label class='labelMusic'>
    Adicionar Áudio<input type='file' name='conteudoMusica' id='conteudoMusica'>
    </label>
    
    
    <input type='hidden' name='fk_categoriaMusica' id='fk_categoriaMusica' value=''>
    
    <input type='hidden' name='qnt_artista_musica' id='qnt_artista_musica'>
    <input type='hidden' name='artistas_musica' id='artistas_musica' value=''>
    
    <button onclick='elementChoiceScreen($cond,`CreateColetionSinger`,`CreateMusicSinger`)' type='button'>
    <img src='../../../imgs/website/icons8-usuário-de-gênero-neutro-48 (1).png' alt=''>
        Adicionar Artista
    </button>
    
    <button onclick='elementChoiceScreen($cond,`CreateColetionCategory`,`CreateMusicCategory`)' type='button'>
    <img src='../../../imgs/website/icons8-música-country-48 (1).png' alt=''>
    
        Adicionar Categoria
    </button>
        
    <button onclick='elementRegisterAction(`MusicRequest`,`create`,`../../musica/create/createMusic.act.php`)' type='button' class='elementSubmit'>
        Cadastrar Musica
    </button>
    
    
    </div>
    </form>";


    $categoryRegister = "<form action='' id='categoryRegister' class='elementRegister'>

    <p> <input class='elementName' type='text' name='nomeCategoria' id='nomeCategoria' placeholder='Nome: '></p>

    <button type='button' onclick='elementRegisterAction(`CategoryRequest`,`create`,`../../categoria/`)' class='elementSubmit'>Cadastrar</button>

</form>";
}

$opcoesElemento = [];

    $singerView = '';


    $singer = mysqli_query($database, "SELECT *FROM `tb_artista`;");

    while ($singers = mysqli_fetch_assoc($singer)) {

        $singerView .= "<div data-value=$singers[id_artista]>

<img src=$singers[foto_artista]>

<div>
<p>$singers[nome_artista]</p>
</div>

</div>";
    }

$singerOptions = "

$singerRegister

<div class='elementOptions' id='singerOptions'>

$singerView

</div>";


    $musicView = '';

    $music = mysqli_query($database, "SELECT *FROM `tb_musica`;");

    while ($musics = mysqli_fetch_assoc($music)) {

        $musicView .= "<div data-value=$musics[id_musica]>

<img src=$musics[foto_musica]>

<div>
<p>$musics[nome_musica]</p>
</div>

</div>";
    }

$musicOptions = "

$musicRegister

<div class='elementOptions' id='musicOptions'>

$musicView

</div>";

    $categoryView = '';

    $category = mysqli_query($database, "SELECT *FROM `tb_categoria`;");


    while ($categories = mysqli_fetch_assoc($category)) {

        $categoryView .= "<div data-value=$categories[id_categoria]>

$categories[nome_categoria]

</div>";
    }



$categoryOptions = "

$categoryRegister

<div class='elementOptions' id='categoryOptions'>

$categoryView

</div>";


$albumView = '';

$album = mysqli_query($database,"SELECT *FROM `tb_album`");

while($albuns = mysqli_fetch_assoc($album)){

    $albumView .= "<div data-value=$albuns[id_album]>

<img src=$albuns[foto_album]>

    <p>$albuns[nome_album]</p>
    
    </div>";

}


$albumOptions = "

<div class='elementOptions' id='albumOptions'>

$albumView

</div>

";

array_push($opcoesElemento,$singerOptions,$musicOptions,$categoryOptions,$albumOptions);

return $opcoesElemento;

}

function getElementView($database,$type,$register){

$elementView = createElementView($database,$type,$register);
$elementTypeView =  [];
$mainScreen = null;
$view = '';

if($type == 'music'){
$mainScreen = 'CreateMusic';
array_push($elementTypeView,$elementView[0],$elementView[2],$elementView[3]);
} else if($type == 'singer'){
    $mainScreen = 'CreateSinger';
    array_push($elementTypeView,$elementView[1],$elementView[3]);
}
 else if($type == 'album'){
$mainScreen = '';
array_push($elementTypeView,$elementView[0],$elementView[1],$elementView[2]);
}

foreach($elementTypeView as $element){

$view .= $element;

}

return "

<section class='selectElement'>

    <div class='searchElement'>

        <input type='search' class='search'>

        <button class='searchId' onclick=''>P</button>

    </div>

    $view

    <div class='operations'>
        <button id='btnRegister'></button>
        <button onclick='elementChoiceScreen(true,`$mainScreen`)'>Fechar</button>
    </div>

</section>";

}



?>

