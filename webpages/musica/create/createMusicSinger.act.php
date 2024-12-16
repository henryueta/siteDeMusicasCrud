<?php

require('../../../database/connect.php');
require('../../module/action/editElementRelation.php');


extract($_POST);

editElementRelation($banco,$idMusicList,"fk_id_musica","tb_musica_artista","fk_id_artista",$idSingerList,false);
