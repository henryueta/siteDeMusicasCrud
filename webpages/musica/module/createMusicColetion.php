<?php


function createMusicColetion($database,$array,$coletion,$fk_id_coletion,$fk_id_music){

    $count = 0;
    $array = explode(",",$array);
    
        // echo json_encode($array);
    
        foreach($array as $fk_value){
    
            $total = mysqli_query($database,"SELECT COUNT(*) AS `total` FROM `$coletion` WHERE `$fk_id_coletion`='$fk_value'");
        
            if($total -> num_rows == 1){
                $number = mysqli_fetch_assoc($total);
                $count = $number['total'];
            }
        
            $count++;
    
            mysqli_query($database,"INSERT INTO `$coletion`
            VALUES(NULL,'$fk_id_music','$fk_value','$count')");
        }
    

}