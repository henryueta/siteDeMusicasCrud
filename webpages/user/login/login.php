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

    <?php

    session_start();
    
    if(isset($_SESSION['logado']) || isset($_SESSION['admLogado'])){
        header('location:../../view/explorer.php');
    } 

    if(isset($_SESSION['msg'])){
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
    }


    ?>


    <section id="setDataPage" class="loginPage">
<!-- 

    <div class="atration">

    <div class="box"></div>

    </div> -->

        <div id="setDataScreen" class="loginScreen">
            <h1><span>Hypp</span>Music</h1>
            <form action="login.act.php" enctype="multipart/form-data" method="post">
                <label for="email">
                    <p>Email</p>
                    <input type="email" name="email" id="email">
                </label>
                <label for="senha">
                    <p>Senha</p>
                    <input type="password" name="senha" id="senha">
                </label>

                <p><a href="#">Esqueceu sua senha?</a></p>
                <p>Não possui uma conta?<abbr title="Crie sua propria conta">
                    <a href="../register/register.php">Criei uma!</a> </abbr></p>
                    <div>
                    <a  href="#"><button id="voltar" type="button">Voltar</button></a>
                    <input type="submit" value="Entrar" id="enviar">
                    </div>
            </form>
           

        </div>

    </section>


</body>

</html>