<?php

function editElementRelation($database, $array, $fk_id_element, $tb_coletion_element, $fk_id_coletion, $value_id_coletion, $reverse)
{
    if (!empty(trim($array))) {
        $array = explode(",", $array); //array

        $coletionElement = mysqli_query($database, "SELECT `$fk_id_element` FROM `$tb_coletion_element` WHERE `$fk_id_coletion` = '$value_id_coletion'");
        $oldElements = [];                     //fk_id_element        //tb_coletion_element          //fk_id_element     //value_id_coletion
    
        while ($coletionElementInfo = mysqli_fetch_assoc($coletionElement)) {
            $oldElements[] = $coletionElementInfo[$fk_id_element];
        }
    
        $addElement = array_diff($array, $oldElements);
        $removeElement = array_diff($oldElements, $array);
    
    
        $newValueColetion = null;
        $newValueElement = null;
    
        foreach ($addElement as $newElementId) {
    
            if ($reverse) {
                $newValueColetion = $newElementId;
                $newValueElement = $value_id_coletion;
            } else{
                $newValueColetion = $value_id_coletion;
                $newValueElement = $newElementId;
            }
    
            mysqli_query($database, "INSERT INTO `$tb_coletion_element`     
                    VALUES (NULL, '$newValueElement', '$newValueColetion')");
        }
    
    
        foreach ($removeElement as $oldElementId) {
            $deleteQuery = "DELETE FROM `$tb_coletion_element` 
                        WHERE `$fk_id_coletion` = '$value_id_coletion' AND `$fk_id_element` = '$oldElementId'";
            mysqli_query($database, $deleteQuery);
        }
        return true;
    } else{
        return false;   
    }



}
