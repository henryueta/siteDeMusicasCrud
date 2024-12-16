<?php

require('../../module/structure/header.php');


createHeader("Editar admin", [
    "../../module/style/menu.css",
    "../../module/style/element.css",
    "../../profile/style/createProfile.css"
]);

?>

<body>

    <?php

    require("../../module/structure/menu.php");
    
    require("../../profile/module/profileData.php");
    extract($_GET);

echo checkProfile();
    

    $admin = mysqli_query($banco, "SELECT * FROM `tb_admin` WHERE `id_admin`='$id_admin'");
    $adminInfo = mysqli_fetch_assoc($admin);
    ?>

    <section class="elementPage">
    <section class="createElementOfProfile">

        <form method="post" enctype="multipart/form-data">

            <?php

            $adminData = createDataView(
                "edit",
                $adminInfo['nome_admin'],
                $adminInfo['email_admin'],
                $adminInfo['senha_admin'],
                $adminInfo['id_admin']
            );

            echo $adminData;

            ?>

            
            <label for="tipo">
                <p>tipo</p>
                <input type="text" name="tipo" id="tipo" value=<?php echo "$adminInfo[tipo_admin]" ?>>
            </label>
            <input type="button" onclick="setDateProfile('admin','edit')" value="Finalizar" id="enviar">
        </form>
    </section>
    </section>
    <script type="module" src="../../profile/scripts/profile.js"></script>

</body>

</html>