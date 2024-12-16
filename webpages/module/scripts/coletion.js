import {
    elementQuery,
    setFormData
}
    from "../../module/scripts/module.js";

import {
    musica, musicId,
    elementConstructor, musicDeleteList,
    musicAlbumClick,
    musicCount,
    pause
} from "../../musica/scripts/music.js";

export const musicList = [];


const playlistClick = (cond) => {
    const playlist = document.querySelectorAll('.playlistChoiceScreen>form>div>input');

    playlist.forEach((ind) => {

        ind.addEventListener('click', () => {

            if (ind.checked) {
                musicList.unshift(ind.value);
            }
            else if (!ind.checked) {
                musicList.splice(musicList.indexOf(ind.value), 1);
            }
        })

    })
}
playlistClick();


const editPlaylistName = document.querySelector("#editPlaylistName");
const playlist_elements = document.querySelectorAll(".playlist-num > li");
export const coletionH1 = document.querySelector(".coletion-name>h1");
const playlistForm = document.querySelector(".playlistChoiceScreen>form");
const playlist_num = document.querySelector(".playlist-num");

const playlistInfo = new FormData();
const albumInfo = new FormData();
let typeOfForm;
export let getNewAlbumName;
const musicNum = document.querySelector(".music-num");


const coletionResponse = {

    "CreatePlaylistResponse": (res, view) => {
        playlist_num.innerHTML = res.toString();
    },
    "UpdatePlaylistResponse": (res, view) => {
        coletionH1.innerHTML = res.toString();
        playlistColetion("", "ListPlaylist");
    },
    "ListPlaylistResponse": (res, view) => {
        viewType.innerHTML = res;
        playlistClick();
    },
    "DeletePlaylistResponse": (res, view) => {
        if (res == true) {
            window.location.href = "../../globalView/navigation/playlists.php";
        }
    },
    "DeleteAlbumResponse": (res, view) => {
        if (res == true) {
            window.location.href = "../../view/explorer.php";
        }
    },
    "SetMusicPlaylistResponse": (res) => {
        document.querySelectorAll("input").forEach((ind) => {
            if (ind.checked) {
                ind.checked = false;
            }
        })
    },
    "DeleteMusicPlaylistResponse": (res) => {
        musicDeleteList.length = 0;
        musicCount.textContent = musicDeleteList.length;
        musicNum.innerHTML = res;
        musicAlbumClick();
    },
    "UpdateAlbumResponse": (res) => {
        coletionH1.innerHTML = res.toString();
    },
    "ListAlbumResponse": (res) => {

    },
    "SetMusicAlbumResponse": (res) => {
        if (!res[0]) {
            alert(res[2]);
        }
    },
    "DeleteMusicAlbumResponse": (res) => {
        musicDeleteList.length = 0;
        musicCount.textContent = musicDeleteList.length;
        musicNum.innerHTML = res;
        musicAlbumClick();
    },
    "SetSingerAlbumResponse": (res) => {
            if (!res[0]) {
                alert(res[2]);
            }
    },
    "DeleteSingerAlbumResponse": (res) => [

    ],
    "SetCategoryAlbumResponse": (res) => {
        if (!res[0]) {
            alert(res[2]);
        }
    }


}
const resetForm = () => {
    queryType = null;
    queryUrl = null;
    responseType = null;
}

const searchPlaylistBtn = document.querySelector("#searchPlaylistBtn");


let queryType;
let queryUrl;
let responseType;
let viewType;

searchPlaylistBtn.addEventListener('click', () => {
    const searchPlaylist = document.querySelector(".searchPlaylist");

    playlistColetion(searchPlaylist.value, `ListPlaylist`);
    viewType = playlistForm;
})




let qnt_music = null;
let qnt_singer = null;
let qnt_category = null;
let dataType = 'html';
export const albumColetion = (type, id, element, newImage) => {
    
    const checkElementOptions = {
        "UpdateAlbum": (name, id, newImage) => {
            albumInfo.set("nomeAlbum", name);
            if (newImage != undefined) {
                albumInfo.set("fotoAlbumNova", newImage);
            }
            albumInfo.set("id_album", id);
            albumInfo.set("qnt_musica",qnt_music);
            albumInfo.set("qnt_artista",qnt_singer);
            albumInfo.set("qnt_categoria",qnt_category);
            queryType = "post";
            queryUrl = "../../album/edit/editAlbum.act.php";
            responseType = "UpdateAlbumResponse";
            typeOfForm = albumInfo;
            
        },
        "DeleteAlbum": (name, id) => {
            let deleteConfirm = confirm("Deseja excluir a coleção " + name + " ?");
            if (deleteConfirm) {
                playlistInfo.set("id_album", id);
                queryType = "get";
                queryUrl = "../../album/delete/deleteAlbum.act.php?id_album=" + id;
                responseType = "DeleteAlbumResponse";
                typeOfForm = albumInfo;
                
            }

        }
    }

    checkElementOptions[type](element, id, newImage);

    elementQuery(queryType, queryUrl, typeOfForm, coletionResponse, responseType,'html');

}
export const playlistColetion = (element, type, id) => {

    const checkElementOptions = {

        "CreatePlaylist": (id) => {
            queryType = "post";
            queryUrl = "../../playlist/create/createPlaylist.act.php";
            responseType = "CreatePlaylistResponse";
            typeOfForm = playlistInfo;
        },
        "UpdatePlaylist": (name, id) => {
            playlistInfo.set("nomePlaylist", name);
            playlistInfo.set("idPlaylist", id);
            queryType = "post";
            queryUrl = "../../playlist/edit/editplaylist.act.php";
            responseType = "UpdatePlaylistResponse";
            typeOfForm = playlistInfo;
        },
        "ListPlaylist": (name) => {
            playlistInfo.set("nomePlaylist", name);
            queryType = "get";
            queryUrl = "../../module/action/search.php?text=" + name + "&type=" + "Playlist";
            responseType = "ListPlaylistResponse";
            typeOfForm = playlistInfo;
        },
        "DeletePlaylist": (name, id) => {
            let deleteConfirm = confirm("Deseja excluir a coleção " + name + " ?");
            if (deleteConfirm) {
                playlistInfo.set("idPlaylist", id);
                queryType = "get";
                queryUrl = "../../playlist/delete/deletePlaylist.act.php?idPlaylist=" + id;
                responseType = "DeletePlaylistResponse";
                typeOfForm = playlistInfo;
            } else {

            }
        },
    }

    checkElementOptions[type](element, id);


    elementQuery(queryType, queryUrl, typeOfForm, coletionResponse, responseType,'html');

}

export const setElementColetion = (array, type, id) => {

    const checkElementOptions = {
        "SetMusicPlaylist": (array) => {
            queryType = "post";
            queryUrl = "../../musica/create/createMusicPlaylist.act.php";
            responseType = "SetMusicPlaylistResponse";
            playlistInfo.set("musicList", array);
            playlistInfo.set("fk_id_musica", musicId);
            typeOfForm = playlistInfo;
        },
        "DeleteMusicPlaylist": (array, id) => {
            queryType = "get";
            queryUrl = "../../musica/delete/deleteMusicPlaylist.act.php?idMusicList=" + array + "&&idColetion=" + id;
            responseType = "DeleteMusicPlaylistResponse";
            typeOfForm = playlistInfo;
        },
        "SetMusicAlbum": (array) => {
            queryType = "post";
            setFormData(albumInfo, [array.toString(), id], ["idMusicList", "idColetion"])
            queryUrl = "../../musica/create/createMusicAlbum.act.php";
            responseType = "SetMusicAlbumResponse";
            typeOfForm = albumInfo;
            qnt_music = array.length;
            dataType = 'json';
        },
        "DeleteMusicAlbum": (array, id) => {
            queryType = "get";
            queryUrl = "../../musica/delete/deleteMusicAlbum.act.php?idMusicList=" + array + "&&idColetion=" + id;
            responseType = "DeleteMusicAlbumResponse";
            typeOfForm = albumInfo;
        },
        "SetSingerAlbum": (array, id) => {
            queryType = "post";
            queryUrl = "../../artista/edit/editSingerAlbum.act.php";
            setFormData(albumInfo, [array.toString(), id], ["idSingerList", "idColetion"])
            responseType = "SetSingerAlbumResponse";
            typeOfForm = albumInfo;
            qnt_singer = array.length;
            dataType = 'json';
        },
        "DeleteSingerAlbum": (array, id) => {
            queryType = "get";
            queryUrl = "../../artista/delete/deleteSingerAlbum.act.php?idSingerList=" + array + "&&idColetion=" + id;
            responseType = "DeleteSingerAlbumResponse";
            typeOfForm = albumInfo;
        },
        "SetCategoryAlbum": (array, id) => {
            queryType = "post";
            queryUrl = "../../categoria/edit/editCategoryAlbum.act.php";
            setFormData(albumInfo, [array.toString(), id], ["idCategoryList", "idColetion"]);
            responseType = "SetCategoryAlbumResponse";
            typeOfForm = albumInfo;
            qnt_category = array.length;
            dataType = 'json';
        },
        "DeleteCategoryAlbum": (array, id) => {

        }
    }


    checkElementOptions[type](array, id);

    elementQuery(queryType, queryUrl, typeOfForm, coletionResponse, responseType,dataType);

}





window.playlistColetion = playlistColetion;
