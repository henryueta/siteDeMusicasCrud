<?php

function createDataView($type,$name,$email,$pass,$id){
$passView = null;
$idView = null;

if($type == "create"){
    $passView = "<input type='password' name='senha' id='senha'>";
} else if($type == "edit"){
    $passView = "<input type='password' name='senha' id='senha' style=display:none>
    <button type='button' class=btnEditPassword onclick='editPass()()'>Redefinir Senha</button>";
    $idView = "<input type='hidden' name='id' id='id' value='$id'>";
}

return "<label for='nome'>
<p>Nome</p>
<input type='text' name='nome' id='nome' value='$name'>
</label>
<label for='email'>
<p>Email</p>
<input type='email' name='email' id='email' value='$email'>
</label>
<label for='senha'>
<p>Senha</p>
<input type='hidden' name='senhaAntiga' id='senhaAntiga' value='$pass'>
$passView
$idView
</label>";


}



