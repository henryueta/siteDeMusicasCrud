<?php

require('../../module/structure/header.php');

createHeader("Editar usuário",[
    "../../module/style/menu.css",
    "../../module/style/element.css",
    "../../profile/style/createProfile.css"
]);

?>
<body>
    
<?php

require("../../module/structure/menu.php");
echo checkProfile();
require("../../profile/module/profileData.php");

extract($_GET);
$user = mysqli_query($banco,"SELECT *FROM `tb_usuario` WHERE `id_usuario`='$id_usuario'");

$userInfo = mysqli_fetch_assoc($user);

?>


<section class="elementPage">   

<section class="createElementOfProfile">

<form enctype="multipart/form-data" method="post" class="profileRegister">


<input type="hidden" name="fotoAntiga" id="fotoAntiga" value="<?php echo $userInfo['foto_usuario'] ?>">
<label for="foto">
        <p>Foto</p>
        <input type="file" name="foto" id="foto">
    </label>
    
<?php

$userData =  createDataView("edit",$userInfo['nome_usuario'],
$userInfo['email_usuario'],
$userInfo['senha_usuario'],
$userInfo['id_usuario'],);

echo $userData;

?>

    <input type="button" onclick="setDateProfile('user','edit')" value="Finalizar" id="enviar">
</form>

</section>

</section>


<script type="module" src="../../profile/scripts/profile.js"></script>

</body>
</html>