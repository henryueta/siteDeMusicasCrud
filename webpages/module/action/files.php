<?php

function editElementFile($newFile,$oldFile,$typeFile,$localFile){
    $local = null;
    if($newFile['size'] > 0){
        $local = $localFile . md5(time() . $newFile['size']) . $typeFile;
        if(trim(empty($oldFile))){
            unlink($oldFile);
        }
        move_uploaded_file($newFile['tmp_name'],$local);
    } else{
        $local = $oldFile;
    }

    return $local;
}