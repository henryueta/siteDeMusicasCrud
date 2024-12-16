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
echo checkProfile();
?>
<section class="elementPage">

<section  class="createElementOfProfile">
    
        
        <?php
        if(isset($_SESSION['msg'])){
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        }
    ?>

            <form action="../../user/create/createUser.act.php" enctype="multipart/form-data" method="post">
            <div class="atration">
            <label for="foto" class="labelFoto">
                    <p>Foto</p>
                    <input type="file" name="foto" id="foto">
                </label>
            </div>
            <div>
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
                    <input type="hidden" name="data" id="data" value="">
                </div>
                <input type="submit" value="Cadastrar usuário" id="enviar">

            </form>
            

    </section>

</section>

</body>
</html>