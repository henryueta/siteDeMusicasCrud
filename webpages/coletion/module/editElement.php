<script type="module" src="../../coletion/scripts/elementColetion.js"></script>
<script type="module" src="../../musica/scripts/music.js"></script>
<script type="module" src="../../coletion/scripts/element.js"></script>

<script type="module">
    import {
        elementOfColetion
    } from "../../coletion/scripts/element.js";
    import {
        singerMusicList,
        singerAlbumList,
        musicAlbumList,
        elementRegisterAction
    } from "../../coletion/scripts/elementColetion.js";
    const music_num = document.querySelectorAll(".music-num>div:not(#titulo-faixas)");
    const musicNum = document.querySelector(".music-num");
    const coletionOptions = document.querySelector(".element-name>div:last-child");
    const coletionCategory = document.querySelector(".element-name>p:nth-child(2)");
    const coletionSinger = document.querySelector(".element-name>p:nth-child(3)");


    const musicPlaylistSubmit = document.querySelector('.musicPlaylistSubmit');

    const editElement = document.querySelector(".editElement");
    const cancelOperation = document.createElement("button");
    const deleteOperation = document.createElement("button");
    const btnAddElement = document.querySelector(".element-add>button");
    const btnAddAlbum = document.querySelector(".album-add>button");
    const elementH1 = document.querySelector(".element-name>h1");

    cancelOperation.textContent = "Cancelar";
    deleteOperation.textContent = "Apagar";
    let newElementName = "<?php
                            if (isset($singerInfoMain)) {
                                echo $singerInfoMain['nome_artista'];
                            }
            else if (isset($musicInfoMain)) {
                echo $musicInfoMain['nome_musica'];
            }
            ?>";
    let elementNameId = "<?php
    
    if(isset($singerInfoMain)){
        echo "nomeArtista";
    } else if(isset($musicInfoMain)){
        echo "nomeMusica";
    }
    
    ?>";

    let editTurn = false;
    //limite 20 letras
    let editInput = document.createElement("input");
    editInput.setAttribute("value", `${newElementName}`);
    editInput.setAttribute("id",elementNameId);
    const fotoAlbumEdit = document.querySelector('#fotoAlbumEdit');



    const typeOfColetion = `<?php
                            if (isset($singerInfoMain)) {
                                echo "singerType";
                            } else if (isset($musicInfoMain)) {
                                echo "musicType";
                            }

                            ?>`;

    const typeOfQuery = `<?php
                            if (isset($singerInfoMain)) {
                                echo "CreateSingerColetion";
                            } else if (isset($musicInfoMain)) {
                                echo "CreateMusicColetion";
                            }

                            ?>`;

    const typeId = `<?php
            if (isset($singerInfoMain)) {
                echo $singerInfoMain['id_artista'];
            } else if (isset($musicInfoMain)) {
                echo $musicInfoMain['id_musica'];
            }
                            
    ?>`;
    

    const setOptionsButton = (display, editMode, text) => {

        if (editMode) {
            coletionOptions.appendChild(cancelOperation);
            coletionOptions.appendChild(deleteOperation);
        } else {
            coletionOptions.removeChild(cancelOperation);
            coletionOptions.removeChild(deleteOperation);
        }

        
            if (display == "flex") {
                display = "none";
            } else {
                display = "flex";
            }
            
            document.querySelector(".element-add").style.display = display;
            document.querySelector(".album-add").style.display = display;

        editElement.textContent = text;

    }

    editElement.addEventListener('click', () => {
        let editElementName = document.querySelector(".element-name>h1>input");

        editTurn = !editTurn;

        if (editTurn) {
            setOptionsButton("none", true, "Pronto");
            elementH1.innerHTML = null;
            elementH1.appendChild(editInput);
        }
        if (!editTurn) {
            let albumSinger;
            let albumImage;

            setOptionsButton("flex", false, "Editar");
            newElementName = editElementName.value;
            if (editElementName.value.length <= 20 && editElementName.value.length != "") {
                if (typeOfColetion == "singerType") {
                    elementRegisterAction(`SingerRequest`,`edit`,`../../artista/edit/editSinger.act.php`);
                    elementOfColetion("SetMusicSinger",singerMusicList,typeId);
                    elementOfColetion("SetAlbumSinger",singerAlbumList,typeId);
                }

            }
        }
    })

    cancelOperation.addEventListener('click', () => {
        editTurn = !editTurn;
        setOptionsButton("flex", false, "Editar")
        elementH1.innerHTML = newElementName;
        editInput.value = newElementName;
    })

    deleteOperation.addEventListener('click', () => {


            elementOfColetion(`DeleteSinger`,null,`<?php echo $singerInfoMain['id_artista'] ?>`);



    })



    musicPlaylistSubmit.addEventListener('click', () => {
        setElementColetion(musicList, "SetMusicPlaylist");
    })

    btnAddElement.addEventListener('click', () => {

        elementChoiceScreen(true, 'CreateColetionMusic', 'SetMusicSinger');

    })

    btnAddAlbum.addEventListener('click', () => {
        
            elementChoiceScreen(true, 'CreateColetionElement', typeOfQuery);
        

    })
</script>