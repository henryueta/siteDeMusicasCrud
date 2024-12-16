<?php

function createHeader($title,$style){
    


echo `<!DOCTYPE html>
<html lang=en>
<head>
    <meta charset=UTF-8>
    <meta name=viewport content="width=device-width", "initial-scale=1.0">
    <title>$title</title>`;
    
    foreach($style as $link){

echo "<link rel=stylesheet href=". $link . ">";

    }
    

echo "</head>";

}