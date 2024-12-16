<?php

extract($_POST);

require('../../../database/connect.php');


if(!empty(trim($musicList))){


$count = 0;
    $musicList = explode(",",$musicList);
    
        // echo json_encode($musicList);
    
        foreach($musicList as $fk_value){
    
            // $total = mysqli_query($banco,"SELECT COUNT(*) AS `total` FROM `tb_playlist_musica` WHERE `fk_id_playlist`='$fk_value'");
        
            // if($total -> num_rows == 1){
            //     $number = mysqli_fetch_assoc($total);
            //     $count = $number['total'];
            // }
        
            // $count++;
    
            mysqli_query($banco,"INSERT INTO `tb_playlist_musica`
            VALUES(NULL,'$fk_id_musica','$fk_value')");
        }

}


// $count = 0;
// if(!empty(trim($musicList))){
// $musicList = explode(",",$musicList);

//     // echo json_encode($musicList);

//     foreach($musicList as $playlist){

//         $total = mysqli_query($banco,"SELECT COUNT(*) AS `total` FROM `tb_playlist_musica` WHERE `fk_id_playlist`='$playlist'");
    
//         if($total -> num_rows == 1){
//             $number = mysqli_fetch_assoc($total);
//             $count = $number['total'];
//         }
    
//         $count++;

//         $musicPlaylistRegister = mysqli_query($banco,"INSERT INTO `tb_playlist_musica`(`id_musica_playlist`,`fk_id_musica`,`fk_id_playlist`,`ordem_musica`)
//         VALUES(NULL,'$fk_id_musica','$playlist','$count')");
//     }

// }

