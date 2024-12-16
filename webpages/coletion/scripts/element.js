
import { elementQuery, setFormData } from "../../module/scripts/module.js";


const coletionResponse = {

    "SetMusicSingerResponse": (res, view) => {

    },
    "SetAlbumSingerResponse": (res, view) => {

    },
    "DeleteMusicSingerResponse": (res, view) => {
    },
    "DeleteAlbumSingerResponse": (res, view) => {
    },
    "DeleteMusicResponse": (res, view) => {
    },
    "DeleteSingerResponse": (res) => {
        window.location.href= "../../globalView/navigation/explorer.php";
    },

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
let typeOfForm;

searchPlaylistBtn.addEventListener('click', () => {
    const searchPlaylist = document.querySelector(".searchPlaylist");

    elementOfColetion(searchPlaylist.value, `ListPlaylist`);
    viewType = playlistForm;
})

const singerInfo = new FormData();

export const elementOfColetion = (type, array, id, idRelation) => {

    const checkElementOptions = {

        "SetMusicSinger": (array, id, idRelation) => {
            setFormData(singerInfo, [array.toString(), id], ["idMusicList", "idSingerList"])
            queryType = "post";
            queryUrl = "../../musica/create/createMusicSinger.act.php";
            responseType = "SetMusicSingerResponse";
            typeOfForm = singerInfo;
        },
        "SetAlbumSinger": (array, id, idRelation) => {
            setFormData(singerInfo, [array.toString(), id], ["idAlbumList", "idSingerList"])
            queryType = "post";
            queryUrl = "../../artista/create/createSingerAlbum.act.php";
            responseType = "SetAlbumSingerResponse";
            typeOfForm = singerInfo;
        },
        "DeleteSinger": (array, id, idRelation) => {
            let deleteConfirm = confirm("Deseja excluir este artista?");
            if (deleteConfirm) {
                queryType = "get";
                queryUrl = "../../artista/delete/deleteSinger.act.php?id_artista=" + id;
                responseType = "DeleteSingerResponse";
                typeOfForm = singerInfo;
            }
        }
    }

    checkElementOptions[type](array, id, idRelation);


    elementQuery(queryType, queryUrl, typeOfForm, coletionResponse, responseType,'html');

}



window.elementOfColetion = elementOfColetion;