<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../style/user.css">
    <link rel="stylesheet" href="../../module/style/element.css">
</head>

<body>

    <!-- <section class="loadPage">

        <div class="load"></div>

    </section> -->

    <section  id="setDataPage" class="registerPage">
    
        <div id="setDataScreen" class="registerScreen">
        <?php
        session_start();
        if(isset($_SESSION['msg'])){
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        }
    ?>
            <h1><span>Hypp</span>Music</h1>

 
           

            <form action="register.act.php" enctype="multipart/form-data" method="post">
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
                <p>Já possui uma conta?<abbr title="Entre na sua conta">
                    <a href="../login/login.php">Acesse agora!</a> </abbr></p>
                <input type="submit" value="Criar Conta" id="enviar">
                </div>
            </form>
            

        </div>

    </section>
<!-- <script src="../scripts/app.js"></script> -->
    <script>

        const data_usuario = document.querySelector("#data");

        const newDate = new Date();

        let gapMonth = newDate.getMonth().toString().length == 1 ? "-0" : "-";
        let gapDay = newDate.getDate().toString().length == 1 ? "-0" : "-";

        data_usuario.value = newDate.getFullYear() +gapMonth+(newDate.getMonth()+1)+gapDay+newDate.getDate();
</script>
</body>

</html>