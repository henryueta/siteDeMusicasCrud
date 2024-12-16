<?php

require('../../../database/connect.php');

require('../../module/action/editElementRelation.php');

extract($_POST);

editElementRelation($banco,$idAlbumList,"fk_id_album","tb_album_artista","fk_id_artista",$idSingerList,true);
