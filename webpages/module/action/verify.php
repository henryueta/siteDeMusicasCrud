<?php


// function check($destino){
//     $local = "../main/error.php";

//     if(isset($_SESSION['admLogado'])){
//          if($_SESSION['admLogado']){
//             $local = $destino;
//         }
//     }

//     header("location:$local");
//     exit();
// }

function checkProfile(){

    if(!isset($_SESSION['admLogado'])){
       return "
       <script>
       
       window.location.href='../../module/structure/error.php';
        
       </script>";
    }

}







