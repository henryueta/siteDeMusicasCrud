// import {
//     musica,
//     musicId,
//     musicDeleteList,
//     musicCount,
//     musicAlbumClick,
//     ativado,
//     elementConstructor,
//     playlistEditScreen,
//     musicEditOptions,
//     resetEditOptions,
//     viewPlaylistEditScreen,
//     musicNodeList,
//     getElement,
//     deleteMusicBtn

// } from "../../musica/scripts/music.js";

// import {
//     playlistColetion,
//         albumColetion,
//         coletionH1,
//         setElementColetion,
//         musicList
// } from "../../module/scripts/coletion.js";

export const toggleElement = (element, style) => {
    const button = document.querySelector(element);
    button.classList.toggle(style);
}

export const removeElement = (element, style) => {
    const button = document.querySelector(element);
    button.classList.remove(style);
}

export const addElement = (element, style) => {
    const button = document.querySelector(element);
    button.classList.add(style);
}

export const setElement = (element, id, style) => {

    const fk = document.querySelector(id);

    if (element.classList.contains(style)) {
        fk.value = element.dataset.value;
    } else {
        fk.value = null;
    }

}

export const inspect = (element, cond, result) => {
    if (element != cond) {
        return result;
    }
}

export const setImg = (img, source) => {
    return img.src = source;
}

export const checkElementList = (elementList, element) => {

    elementList.forEach((ind, num) => {
        if (element.dataset.value == elementList[num]) {
            let teste = elementList.indexOf(element.dataset.value);
            elementList.splice(teste, 1);
        } else {
        }
    })
}
export const elementArrayClass = (array, style, type, lista) => {

    array.forEach((ind, num) => {
        lista.forEach((ele, i) => {

            if (type == "remove") {
                if (lista[i].dataset.value == ind) {
                    lista[i].classList.remove(style);
                }
            } else if (type == "add") {
                if (lista[i].dataset.value == ind) {
                    lista[i].classList.add(style);
                }
            }

        })
    })

}

export const objectBlock = (id, situation) => {
    return id.disabled = situation;
}

export const choiceElement = (array, num, style, on, off) => {

    // let playIcon = element;
    // let stopIcon = "";
    // if (playIcon.src = off) {
    //     playIcon.src = on;
    // }



    for (let i = 0; i < array.length; i++) {
        if (array[i].classList.contains(style)) {
            if (array[i] != array[num]) {
                array[i].classList.remove(style);
                if (on != undefined) {
                    // stopIcon = array[i].children[0].children[0];
                }
                // inspect(on, undefined, stopImg(stopIcon, on));
            } else {
                // inspect(off, undefined, stopImg(playIcon, off));
            }

        }
    }
}

export const setArrayData = (array, elementArray) => {

    elementArray.forEach((ind, num) => {

        array.push(ind);

    })


}


export const setFormData = (Form, dataArray, nameArray) => {

    dataArray.forEach((ind, num) => {

        if (dataArray[num] != undefined) {

            Form.set(nameArray[num], dataArray[num]);

        }


    })

}

export const elementQuery = (type, url, form, response, typeOfResponse,data) => {
    $.ajax({
        type: type,
        data: form,
        dataType: data,
        contentType: false,
        processData: false,
        url: url,
        success: (res) => {
            response[typeOfResponse](res);
        },
        error: (res) => {
        }

    })
}

// export {
//     musica,
//     musicId,
//     musicDeleteList,
//     musicCount,
//     musicAlbumClick,
//     ativado,
//     elementConstructor,
//     playlistEditScreen,
//     musicEditOptions,
//     resetEditOptions,
//     viewPlaylistEditScreen,
//     musicNodeList,
//     getElement,
//     deleteMusicBtn,


//     playlistColetion,
//         albumColetion,
//         coletionH1,
//         setElementColetion,
//         musicList,



//     toggleElement,
//     addElement,
//     removeElement,
//     inspect,
//     setImg,
//     setElement,
//     objectBlock,
//     checkElementList,
//     elementArrayClass,
//     choiceElement,
//     elementQuery
// }