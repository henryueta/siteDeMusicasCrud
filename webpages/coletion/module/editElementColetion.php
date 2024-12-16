<script type="module">
    // import {
    //     musicAlbumClick,
    //     ativado,
    //     elementConstructor,
    //     playlistEditScreen,
    //     musicEditOptions,
    //     resetEditOptions,
    //     viewPlaylistEditScreen,
    //     musicDeleteList,
    //     musicNodeList,
    //     getElement,
    //     deleteMusicBtn
    // } from "../../musica/scripts/music.js";
    // import {
    //     playlistColetion,
    //     albumColetion,
    //     coletionH1,
    //     setElementColetion,
    //     musicList
    // } from "../../module/scripts/coletion.js";
    import {
        removeElement,
        playlistColetion,
        albumColetion,
        coletionH1,
        setElementColetion,
        musicList,
        musica,
        musicId,
        musicDeleteList,
        musicCount,
        musicAlbumClick,
        ativado,
        elementConstructor,
        playlistEditScreen,
        musicEditOptions,
        resetEditOptions,
        viewPlaylistEditScreen,
        musicNodeList,
        getElement,
        deleteMusicBtn
    }
    from "../../module/scripts/group.js";

    import {
        coletionSingerList,
        coletionMusicList,
        coletionCategoryList
    } from "../../coletion/scripts/elementColetion.js";
    const music_num = document.querySelectorAll(".music-num>div:not(#titulo-faixas)");
    const musicNum = document.querySelector(".music-num");
    const coletionOptions = document.querySelector(".coletion-name>div:last-child");
    const coletionCategory = document.querySelector(".coletion-category");
    const coletionSinger = document.querySelector(".coletion-singer");


    const musicPlaylistSubmit = document.querySelector('.musicPlaylistSubmit');

    const startAlbum = document.querySelector(".startAlbum");
    const editColetion = document.querySelector(".editColetion");
    const cancelOperation = document.createElement("button");
    const deleteOperation = document.createElement("button");
    const btnAddMusic = document.querySelector(".music-add>button");
    // const coletionH1 = document.querySelector("coletion-name>h1");

    cancelOperation.textContent = "Cancelar";
    deleteOperation.textContent = "Apagar";
    let newColetionName = "<?php
                            if (isset($playlistInfo)) {
                                echo $playlistInfo['nome_playlist'];
                            } else if (isset($albumInfo)) {
                                echo $albumInfo['nome_album'];
                            }
                            ?>";

    let editTurn = false;
    //limite 20 letras
    let editInput = document.createElement("input");
    let editSinger = document.createElement("button");
    let editCategory = document.createElement("button");


    editInput.setAttribute("value", `${newColetionName}`);
    editSinger.className = "editSinger";
    editCategory.className = "editCategory";

    const fotoAlbumEdit = document.querySelector('#fotoAlbumEdit');



    const typeOfColetion = `<?php
                            if (isset($playlistInfo)) {
                                echo "playlistType";
                            } else if (isset($albumInfo)) {
                                echo "albumType";
                            }

                            ?>`;

let albumImage =document.querySelector("#albumImage");

    const setOptionsButton = (display, editMode, text) => {
        startAlbum.style.display = display;
        if (typeOfColetion == "albumType") {
            albumImage.style.display = display;
            if (display == "flex") {
                display = "none";
            } else {
                display = "flex";
            }
            document.querySelector(".music-add").style.display = display;
            document.querySelector("#labelForEditAlbum").style.display = display;
        }

        editColetion.textContent = text;
        if (editMode) {
            coletionOptions.appendChild(cancelOperation);
            coletionOptions.appendChild(deleteOperation);
            if (typeOfColetion == "albumType") {
                coletionCategory.append(editCategory);
                coletionSinger.append(editSinger);
            }
        } else {
            coletionOptions.removeChild(cancelOperation);
            coletionOptions.removeChild(deleteOperation);
            if (typeOfColetion == "albumType") {
                coletionCategory.removeChild(editCategory);
                coletionSinger.removeChild(editSinger);
            }

        }
    }


    editColetion.addEventListener('click', () => {
        let editColetionName = document.querySelector(".coletion-name>h1>input");

        editTurn = !editTurn;

        if (editTurn) {
            setOptionsButton("none", true, "Pronto");
            coletionH1.innerHTML = null;
            coletionH1.appendChild(editInput);
            elementConstructor(false);
            if (typeOfColetion == "playlistType") {
                viewPlaylistEditScreen("flex");
                resetEditOptions();

            }
        }
        if (!editTurn) {
            let albumSinger;

            coletionH1.removeChild(editInput)

            setOptionsButton("flex", false, "Editar");
            newColetionName = editColetionName.value;
        coletionH1.innerHTML = newColetionName;
        albumImage.src = fotoAlbumEdit.files[0]
            if (editColetionName.value.length <= 20 && editColetionName.value.length != "") {
                if (typeOfColetion == "playlistType") {

                    playlistColetion(editColetionName.value,
                        `<?php echo "UpdatePlaylist"; ?>`,
                        `<?php echo $playlistInfo['id_playlist']; ?>`);

                    setElementColetion(musicDeleteList,
                        `<?php echo "DeleteMusicPlaylist"; ?>`,
                        deleteMusicBtn.value);
                    viewPlaylistEditScreen("none")
                    resetEditOptions();

                } else if (typeOfColetion == "albumType") {

                    setElementColetion(
                        getElement(coletionSingerList),
                        "SetSingerAlbum",
                        `<?php if (isset($albumInfo)) {
                                echo $albumInfo['id_album'];
                            } ?>`);

                    setElementColetion(
                        getElement(coletionMusicList),
                        "SetMusicAlbum",
                        `<?php if (isset($albumInfo)) {
                                echo $albumInfo['id_album'];
                            } ?>`
                    );
                    setElementColetion(
                        getElement(coletionCategoryList),
                        "SetCategoryAlbum",
                        `<?php if (isset($albumInfo)) {
                                echo $albumInfo['id_album'];
                            } ?>`
                    )

                    albumColetion("UpdateAlbum",
                        `<?php echo $albumInfo['id_album']; ?>`,
                        editColetionName.value,
                        fotoAlbumEdit.files[0],
                        
                    );



                }
            }
            elementConstructor(true);

        }
    })


    editCategory.addEventListener('click', () => {
        elementChoiceScreen(true, "CreateColetionCategory", 'EditAlbumCategory')
    })
    editSinger.addEventListener('click', () => {
        elementChoiceScreen(true, "CreateColetionSinger", 'EditAlbumSinger')
    })

    cancelOperation.addEventListener('click', () => {
        editTurn = !editTurn;
        setOptionsButton("flex", false, "Editar")
        coletionH1.innerHTML = newColetionName;
        
        if (typeOfColetion == "playlistType") {
            elementConstructor(true);
            viewPlaylistEditScreen("none")
            resetEditOptions();

        }

    })

    deleteOperation.addEventListener('click', () => {

        if (typeOfColetion == "playlistType") {
            playlistColetion(`<?php
                                echo $playlistInfo['nome_playlist'];

                                ?>`, `<?php
                                        echo "DeletePlaylist";
                                        ?>`, `
                                <?php
                                echo $playlistInfo['id_playlist'];
                                ?>`)
        } else if (typeOfColetion == "albumType") {
            albumColetion(`<?php
                            echo "DeleteAlbum"
                            ?>`, `<?php
                                    echo $albumInfo['nome_album'];
                                    ?>`,
                `<?php
                    echo $albumInfo['id_album']
                    ?>`)
        }


    })



    musicPlaylistSubmit.addEventListener('click', () => {
        setElementColetion(musicList, "SetMusicPlaylist");
    })

    btnAddMusic.addEventListener('click', () => {

        elementChoiceScreen(true, 'CreateColetionMusic', 'EditAlbumMusic');

    })
</script>