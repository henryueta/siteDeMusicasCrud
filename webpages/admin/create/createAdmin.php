<?php

require('../../module/structure/header.php');

createHeader("controller",[
    "../style/controller.css",
    "../../module/style/menu.css",
    "../../module/style/element.css",
    "../../profile/style/createProfile.css"
]);

?>
<body>
    

<?php


require('../../module/structure/menu.php');
echo checkProfile()

?>

<section class="elementPage">

<section class="createElementOfProfile">
<?php
            if(isset($_SESSION['msg'])){
                echo $_SESSION['msg'];
                unset($_SESSION['msg']);
            }
            ?>
<form action="createAdmin.act.php" method="post" enctype="multipart/form-data">

    <label for="nome">
        <p>Nome</p>
        <input type="text" name="nome" id="nome">
    </label>
    <label for="email">
        <p>Email</p>
        <input type="email" name="email" id="email">
    </label>
    <label for="senha">
        <p>Senha</p>
        <input type="password" name="senha" id="senha">
    </label>
    <label for="tipo">
        <p>tipo</p>
        <input type="text" name="tipo" id="tipo">
    </label>


    
    <input type="submit" value="Enviar">

</form>

</section>


</section>

</body>
</html>