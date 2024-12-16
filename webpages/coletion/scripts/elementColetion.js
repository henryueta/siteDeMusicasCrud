
import {
    toggleElement,
    addElement,
    removeElement,
    inspect,
    setImg,
    setElement,
    objectBlock,
    checkElementList,
    elementArrayClass,
    choiceElement,
    elementQuery
} from "../../module/scripts/module.js";

function define(value, type) {
    return document.querySelector(value);
}


const singerOptions = define("#singerOptions", "simple");
const musicOptions = define("#musicOptions", "simple");
const categoryOptions = define("#categoryOptions", "simple");
const albumOptions = define("#albumOptions","simple");


const areaSinger = define("#singerOptions>div", "simple")
const areaMusic = define("#musicOptions>div", "simple")

const btnRegister = document.querySelector("#btnRegister");
const selectElement = document.querySelector(".selectElement");
const searchId = document.querySelector(".searchId");


const viewElementQuery = {

    "tb_artista": (content) => {
        justScreenView(true, singerOptions, "flex");
        singerOptions.innerHTML = content;
        singersClick();
    },
    "tb_musica": (content) => {
        justScreenView(true, musicOptions, "flex");
        musicOptions.innerHTML = content;
        musicsClick();
    },
    "tb_categoria": (content) => {
        justScreenView(true, categoryOptions, "flex");
        categoryOptions.innerHTML = content;
        categoryClick();
    },
    "tb_album":(content)=>{
        justScreenView(true, albumOptions, "flex");
        albumOptions.innerHTML = content;
        albumClick();
    }

}


// main.js


document.addEventListener("DOMContentLoaded", () => {
    document.querySelector("#btnRegister").addEventListener("click", () => {
        elementRegisterScreen(registerType)
    });
    
});


const inputs = document.querySelectorAll("input");

const inputsFile = {

"fotoAlbum":(input)=>{
    fileView("#labelForFotoAlbum",input.files[0]);
},
"fotoArtista":(input)=>{
    fileView("#labelForFotoArtista",input.files[0]);
},
"fotoMusica":(input)=>{
    fileView("#labelForFotoMusica",input.files[0]);
},
"fotoAlbumEdit":(input)=>{
    fileView("#labelForEditAlbum",input.files[0]);
    setTimeout(()=>{
        fileView(".backAlbum",input.files[0]);
    },300)
}

}



inputs.forEach((ind,num)=>{
    ind.addEventListener('change',()=>{
        if(ind.type == "file"){
            inputsFile[ind.id](ind);
        }
    })
})

    const resetFileView = (label)=>{
        return document.querySelector(label).style.backgroundImage = "url()";
    }

    const leitor  = new FileReader();
    const fileView = (view,file)=>{
        
        leitor.onload = (e)=>{
            document.querySelector(view).style.backgroundImage = "url("+e.target.result+")";
            leitor.onload = null;
        }
        leitor.readAsDataURL(file); 
    }


const text = document.querySelector(".search");



export function searchElement(typeContent) {


    $.ajax({
        type: "GET",
        url: "../../module/action/search.php?text=" + text.value + "&type=" + typeContent,
        success: (res) => {
            viewElementQuery[typeContent](res);
        },
        error:(res)=>{
        }
    })

}



const exitScreenOption = (music, singer, category) => {
}

const singerScreenOption = () => {
}

const musicScreenOption = () => {
}

const categoryScreenOption = () => {
}

let singerRegister = document.querySelector("#singerRegister");
let musicRegister = document.querySelector("#musicRegister");
let categoryRegister = document.querySelector("#categoryRegister");

let singerView = document.querySelector("#singerView");


const justScreenView = (justOneScreen, screenType, displayType) => {

    let screenTypeList = [
        singerRegister,
        musicRegister,
        categoryRegister,
        singerView,
        singerOptions,
        musicOptions,
        categoryOptions,
        albumOptions
    ];

    screenTypeList.forEach((ind, num) => {
        if (justOneScreen) {
            if (screenType == ind) {     
           
                ind.style.display = displayType;
            } else if (screenType != ind) {
                if(screenTypeList[num] != null){
                    screenTypeList[num].style.display = "none";
                }
            }
        } else {
            if(screenTypeList[num] != null){
                screenTypeList[num].style.display = "none";
            }
        }
    })

}

export let registerType;
export let searchType;

let screenType;
let singerOfAlbum = [];
let singerOfMusic = [];

let categoryOfAlbum = [];
let categoryOfMusic;


export let coletionSingerList = [];
export const singerListConstructor = (array)=>{
    return coletionSingerList = array;
}

export let coletionMusicList = [];
export const musicListConstructor = (array)=>{
    return coletionMusicList = array;
}

export let coletionCategoryList = [];
export const categoryListConstructor = (array)=>{
    return coletionCategoryList = array;
}

export let singerMusicList = [];
export const  singerMusicConstructor = (array)=>{
    return singerMusicList = array;
}

export let singerAlbumList = [];
export const singerAlbumConstructor = (array)=>{
    return singerAlbumList = array;
}

export let musicAlbumList = [];
export const musicAlbumConstructor = (array)=>{
    return musicAlbumList = array;
}


const checkSelectedElements = (arrayToSelect,arrayToCheck,toggleElementId,style,text)=>{
    arrayToSelect.forEach((ind,num)=>{
        let selectedElement = arrayToCheck.filter((item)=> item == ind.dataset.value);
        selectedElement.forEach(item=> addElement(`${toggleElementId}>div:nth-child(  ${num + 1}  )`,style))
     })
    //  btnElementOfColetion.textContent = text;
}

const checkElementOptions = (element) => {
    const elementOption = {

        "CreateColetionSinger": () => {

            const singers = document.querySelectorAll("#singerOptions > div");

            if (elementTableQuery == "CreateAlbumSinger" && singerOfAlbum != undefined && singerOfMusic != undefined) {

                elementArrayClass(singerOfAlbum, "ativo", "add", singers);
                elementArrayClass(singerOfMusic, "ativo", "remove", singers);

                // removeElement("#singerOptions>div:nth-child(" + singerOfMusic + ")", "ativo");
                // addElement("#singerOptions>div:nth-child(" + singerOfAlbum + ")", "ativo");

            } else if (elementTableQuery == "CreateMusicSinger" && singerOfMusic != undefined && singerOfAlbum != undefined) {


                elementArrayClass(singerOfAlbum, "ativo", "remove", singers);
                elementArrayClass(singerOfMusic, "ativo", "add", singers);
                
                // addElement("#singerOptions>div:nth-child(" + singerOfMusic + ")", "ativo");
                // removeElement("#singerOptions>div:nth-child(" + singerOfAlbum + ")", "ativo");

            } else if (elementTableQuery == "CreateMusicSinger" && singerOfMusic == undefined && singerOfAlbum != undefined) {
                
                elementArrayClass(singerOfAlbum, "ativo", "remove", singers);

                // removeElement("#singerOptions>div:nth-child(" + singerOfAlbum + ")", "ativo");
            } else if (elementTableQuery == "CreateAlbumSinger" && singerOfAlbum == undefined && singerOfMusic != undefined) {

                elementArrayClass(singerOfMusic, "ativo", "remove", singers);

                // removeElement("#singerOptions>div:nth-child(" + singerOfMusic + ")", "ativo");
            }
            objectBlock(text, false);
            objectBlock(searchId, false)
            justScreenView(true, singerOptions, "flex");
            searchType = 'tb_artista';
            text.setAttribute("placeholder", "Pesquise o seu artista")
            if (elementTableQuery == "CreateAlbumSinger") {
                btnRegister.textContent = "Cadastrar Artista";
            } else if(elementTableQuery == "EditAlbumSinger"){
                checkSelectedElements(singers,coletionSingerList,"#singerOptions","ativo","Artistas do Álbum");
            } else if(elementTableQuery == "SetMusicSinger"){
                checkSelectedElements(singers,coletionSingerList,"#singerOptions","ativo","Artistas do Álbum");
            }
        },
        "CreateColetionMusic": () => {
            const musics = document.querySelectorAll("#musicOptions > div");

            objectBlock(text, false);
            objectBlock(searchId, false)
            justScreenView(true, musicOptions, "flex");
            searchType = "tb_musica";
            text.setAttribute("placeholder", "Pesquise a sua música");
            if (elementTableQuery == "CreateAlbumMusic") {
                btnRegister.textContent = "Cadastrar Música";
            } else if(elementTableQuery == "EditAlbumMusic"){
                checkSelectedElements(musics,coletionMusicList,"#musicOptions","ativo","Músicas do Álbum");
            } else if(elementTableQuery == "SetMusicSinger"){
                checkSelectedElements(musics,singerMusicList,"#musicOptions","ativo","Músicas do Álbum");
            }
        },
        "CreateColetionCategory": () => {

            const categories = document.querySelectorAll("#categoryOptions > div");


            if (elementTableQuery == "CreateAlbumCategory" && categoryOfAlbum != undefined && categoryOfMusic != undefined) {

                removeElement("#categoryOptions>div:nth-child(" + categoryOfMusic + ")", "ativo");
                elementArrayClass(categoryOfAlbum, "ativo", "add", categories);

            } else if (elementTableQuery == "CreateMusicCategory" && categoryOfMusic != undefined && categoryOfAlbum != undefined) {

                addElement("#categoryOptions>div:nth-child(" + categoryOfMusic + ")", "ativo");
                elementArrayClass(categoryOfAlbum, "ativo", "remove", categories);


            } else if (elementTableQuery == "CreateMusicCategory" && categoryOfMusic == undefined && categoryOfAlbum != undefined) {

                elementArrayClass(categoryOfAlbum, "ativo", "remove", categories);


            } else if (elementTableQuery == "CreateAlbumCategory" && categoryOfAlbum == undefined && categoryOfMusic != undefined) {

                removeElement("#categoryOptions>div:nth-child(" + categoryOfMusic + ")", "ativo");

            }

            objectBlock(text, false);
            objectBlock(searchId, false)
            justScreenView(true, categoryOptions, "flex");
            searchType = "tb_categoria";
            text.setAttribute("placeholder", "Pesquise a sua categoria")

            if (elementTableQuery == "CreateAlbumCategory") {
                btnRegister.textContent = "Cadastrar Categoria";
            } else if(elementTableQuery == "EditAlbumCategory"){
                checkSelectedElements(categories,coletionCategoryList,"#categoryOptions","ativo","Categorias do Álbum");
            }
        },
        "CreateColetionElement":()=>{

            const albuns = document.querySelectorAll("#albumOptions > div");


            objectBlock(text, false);
            objectBlock(searchId, false)
            justScreenView(true, albumOptions, "flex");
            searchType = "tb_album";
            text.setAttribute("placeholder", "Pesquise o seu álbum")
            if(elementTableQuery == "CreateSingerColetion"){
                checkSelectedElements(albuns,singerAlbumList,"#albumOptions","ativo","");
            } else if(elementTableQuery == "CreateMusicColetion"){
                checkSelectedElements(albuns,musicAlbumList,"#albumOptions","ativo","");
            }

        },
        "CreateSinger":()=>{

        },
        "CreateMusic":()=>{
        justScreenView(true,musicRegister,"flex",);
        },
        "": () => {
            justScreenView(false);
            text.value = "";
        },
        "Novo Artista": () => {
            btnRegister.textContent = "Voltar";
        },
        "Nova Música": () => {
            btnRegister.textContent = "Voltar";
        },
        "Nova Categoria": () => {
            btnRegister.textContent = "Voltar";

        }

    }
    elementOption[element]();
    searchId.setAttribute("onclick", `searchElement('${searchType}')`);
}

let elementTableQuery;

export const elementChoiceScreen = (Toggle, ind, fk) => {
    registerType = ind;
    window.registerType = registerType;

    elementTableQuery = fk;
    checkElementOptions(ind);

    if (Toggle) {
        selectElement.classList.toggle("procurar");
    }
}

export const elementRegisterScreen = (element) => {
    const elementOption = {

        "CreateColetionSinger": () => {

            objectBlock(text, true);
            objectBlock(searchId, true)

            const checkTypeForSinger = {

                "CreateAlbumSinger": () => {
                    justScreenView(true, singerRegister, "flex");
                    registerType = "Novo Artista";

                },
                "CreateMusicSinger": () => {
                    justScreenView(true, musicRegister, "flex");
                    registerType = "Nova Música";

                }               

            }
            checkTypeForSinger[elementTableQuery]();
            checkElementOptions(registerType)

        },
        "CreateColetionMusic": () => {
            objectBlock(text, true);
            objectBlock(searchId, true)
            justScreenView(true, musicRegister, "flex");
            registerType = "Nova Música";
            checkElementOptions(registerType)
        },
        "CreateColetionCategory": () => {
            objectBlock(text, true);
            objectBlock(searchId, true)

            const checkFkForCategory = {

                "CreateAlbumCategory": () => {
                    justScreenView(true, categoryRegister, "flex");
                    registerType = "Nova Categoria";
                },
                "CreateMusicCategory": () => {
                    justScreenView(true, musicRegister, "flex");
                    registerType = "Nova Música";
                }

            }
            checkFkForCategory[elementTableQuery]();

            checkElementOptions(registerType)
        },
        "Novo Artista": () => {
            objectBlock(text, false);
            objectBlock(searchId, false)

            justScreenView(true, singerOptions, "flex");
            registerType = "CreateColetionSinger";
            checkElementOptions(registerType)

        },
        "Nova Música": () => {
            objectBlock(text, false);
            objectBlock(searchId, false)
            justScreenView(true, musicOptions, "flex");
            registerType = "CreateColetionMusic";
            checkElementOptions(registerType)

        },
        "Nova Categoria": () => {
            objectBlock(text, false);
            objectBlock(searchId, false)
            justScreenView(true, categoryOptions, "flex");
            registerType = "CreateColetionCategory";
            checkElementOptions(registerType)
        }
    }

    return elementOption[element]();
}

export const elementViewScreen = (element)=>{
    
const elementOption = {
    "Visualizar Artista": ()=>{
        
        if(elementTableQuery == "EditAlbumSinger"){

        justScreenView(true,singerView, "flex");

        }   

    }
}

return elementOption[element]();

}


const formData = new FormData();
const resetForm = (form)=>{
    form.forEach((ind, num) => {
        form[num] = null;
    })
}

const resetArray = (array)=>{
    return array.length = 0;
}


export const elementRegisterAction = (element,type,url) => {


    let elementUrlAct;
    let nome;
    let foto;
    let fotoAntiga;
    let musica;
    let musicaAntiga;
    let artista;
    let qnt_artista;
    let categoriaFk;
    let id;
    let data;

    const setFormInfo = (name, content, photo, content2, music, content3) => {

        if (content != undefined || content != "") {
            formData.set(name, content);
        }
        if (content2 != undefined) {
            formData.set(photo, content2);
        }
        if (content3 != undefined) {
            formData.set(music, content3);
        }
        
    }
    const errorScreen = document.querySelector('.errorScreen');

    let typeResponse;
    const elementRequest = {

        "SingerRequest": () => {
            typeResponse = "SingerResponse";
            elementUrlAct = url;
            nome = document.querySelector("#nomeArtista");
            foto = document.querySelector("#fotoArtista");
            setFormInfo("nomeArtista", nome.value, "fotoArtista", foto.files[0]);
            if(type == "edit"){
                formData.set("fotoArtistaAntigo",document.querySelector("#fotoArtistaAntigo").value)
                formData.set("id_artista",document.querySelector("#id_artista").value)
            } else{
                data = document.querySelector("#data");
            formData.set("data",data.value);
            }
        },
        "MusicRequest": () => {
            typeResponse = "MusicResponse";
            elementUrlAct = url;
            nome = document.querySelector("#nomeMusica");
            foto = document.querySelector("#fotoMusica");
            musica = document.querySelector("#conteudoMusica");
            artista = document.querySelector("#artistas_musica");
            qnt_artista = document.querySelector("#qnt_artista_musica");
            categoriaFk = document.querySelector("#fk_categoriaMusica");
            let fotoValue = foto.files[0];
            let musicaValue = musica.files[0];
            setFormInfo("nomeMusica", nome.value, "fotoMusica",fotoValue, "conteudoMusica", musicaValue);
            formData.set("fk_categoriaMusica", categoriaFk.value);
            formData.set("artistas_musica", artista.value);
            formData.set("qnt_artista",qnt_artista.value);
            if(type == "edit"){
            id = document.querySelector("#id_musica");
            fotoAntiga = document.querySelector("#fotoMusicaAntigo");
            musicaAntiga = document.querySelector("#conteudoMusicaAntigo");
            formData.set("id_musica",id.value);
            formData.set("fotoMusicaAntigo",fotoAntiga.value);
            formData.set("conteudoMusicaAntigo",musicaAntiga.value);
            }
            
            
        },
        "CategoryRequest": () => {
            typeResponse = "CategoryResponse";
            elementUrlAct = "../../categoria/create/createCategory.act.php";
            nome = document.querySelector("#nomeCategoria");
            setFormInfo("nomeCategoria", nome.value);
        },
    }
    elementRequest[element]();




    const elementResponse = {

        "SingerResponse": (content) => {
            if(type == "create"){
                resetFileView("#labelForFotoArtista");
                if (content[0]) {
                    singerOptions.innerHTML = content[1];
                } else {
                    alert(content[2]);
                }
            }
            singersClick();
            
        },
        "MusicResponse": (content) => {
            if (content[0]) {
                musicOptions.innerHTML = content[1];
            } else {
                alert(content[2]);
            }
            musicsClick();
            const singers = document.querySelectorAll("#singerOptions > div");
            elementArrayClass(singerOfMusic, "ativo", "remove", singers);
            toggleElement("#categoryOptions>div:nth-child(" + categoryOfMusic + ")", "ativo");
            resetArray(listSingerMusic);
            resetFileView("#labelForFotoMusica");
        },
        "CategoryResponse": (content) => {
            if (content[0]) {
                categoryOptions.innerHTML = content[1];
            } else {
                alert(content[2]);
            }
            categoryClick();
        },
    }



    $.ajax({
        type: "post",
        data: formData,
        contentType: false,
        processData: false,
        dataType: 'json',
        url: elementUrlAct,
        success: (res) => {
            elementResponse[typeResponse](res);
            if(type == "create"){
                nome.value = null;
                artista.value = null;
                qnt_artista.value = null;
                categoriaFk.value = null;
            }
            
            if (typeResponse != "CategoryResponse") {
                foto.value = "";
            }
            resetForm(formData);
            // if(errorScreen.style.display == "flex"){

            //     setTimeout(() => {
            //         errorScreen.style.display = "none";
            //     }, 2000);
            // }

        },
        error: (res) => {
            
        }
    })

    
}

let countIndex = 0;/////Corrigir 
const createColetionElement = (index,num,array,style,toggleElementId,count,createElementId,qnt_element)=>{

    let indice = num + 1;

    if(array.length < 5 && !index.classList.contains(style)){//criar
        addElement(`${toggleElementId}>div:nth-child(${indice})`, style);//criar
        } else if(array.length <= 5 && ind.classList.contains(style)){//criar
        removeElement(`${toggleElementId}>div:nth-child(${indice})`, style);//criar
        }

    if (index.classList.contains(style) && array.length < 5) {//criar
        checkElementList(array, index);//criar
        countIndex++;//criar
        array.push(index.dataset.value);//criar
    }

    if (!index.classList.contains(style)) {//criar
        checkElementList(array, index);//criar
        countIndex--;//criar

    }
    count = countIndex;
    let createElement = document.querySelector(createElementId);//criar
    createElement.value = array;//criar
    qnt_element.value = count;//criar

}

const deleteColetionElement = (url,id)=>{

    let deleteConfirm = confirm("Deseja excluir esta música?");
    if(deleteConfirm){
        window.location.href = url+id;
    }

}

const editColetionElement = (elementList,index,num,style,toggleElementId)=>{

    let indice = num + 1;
    let verifyElement = elementList.filter(item => item == index.dataset.value);//editar
    if(verifyElement.length > 0){//editar
    let deleteConfirm = confirm("Deseja remover este elemento?")//editar
        if(deleteConfirm){//editar
            elementList.splice(elementList.indexOf(index.dataset.value),1);//editar
            removeElement(`${toggleElementId}>div:nth-child( ${indice} )`, style);//editar
        }

    } else{
        elementList.unshift(index.dataset.value);//editar
         addElement(`${toggleElementId}>div:nth-child( ${indice} )`, style);//editar
    }

}

const albumForm = document.querySelector(".albumForm");
let qnt_musica = document.querySelector("#qnt_musica");

let numberOfSingerAlbum = 0;
let numberOfSingerMusic = 0;

export let listSingerAlbum = [];
let listSingerMusic = [];

let qnt_artista_musica = document.querySelector("#qnt_artista_musica");
let qnt_artista_album = document.querySelector("#qnt_artista_album");

const singersClick = () => {
    const singers = document.querySelectorAll("#singerOptions > div");

    singers.forEach((ind, num) => {
        ind.addEventListener('click', () => {
            let indice = num + 1;



            if (elementTableQuery == "CreateAlbumSinger") {

                // if(listSingerAlbum.length < 5 && !ind.classList.contains("ativo")){//criar
                //     addElement("#singerOptions>div:nth-child(" + indice + ")", "ativo");//criar
                //     } else if(listSingerAlbum.length <= 5 && ind.classList.contains("ativo")){//criar
                //     removeElement("#singerOptions>div:nth-child(" + indice + ")", "ativo");//criar
                //     }

                // if (ind.classList.contains("ativo") && listSingerAlbum.length < 5) {//criar
                //     checkElementList(listSingerAlbum, ind);//criar
                //     numberOfSingerAlbum++;//criar
                //     listSingerAlbum.push(ind.dataset.value);//criar
                // }

                // if (!ind.classList.contains("ativo")) {//criar
                //     checkElementList(listSingerAlbum, ind);//criar
                //     numberOfSingerAlbum--;//criar
                // }
                // let artistas = document.querySelector("#artistas");//criar
                // artistas.value = listSingerAlbum;//criar
                // qnt_artista_album.value = numberOfSingerAlbum;//criar


                createColetionElement(ind,num,listSingerAlbum,"ativo","#singerOptions",numberOfSingerAlbum,"#artistas",qnt_artista_album);

            } else if (elementTableQuery == "CreateMusicSinger") {


                if(listSingerMusic.length < 5 && !ind.classList.contains("ativo")){//criar
                addElement("#singerOptions>div:nth-child(" + indice + ")", "ativo");//criar
                } else if(listSingerMusic.length <= 5 && ind.classList.contains("ativo")){//criar
                removeElement("#singerOptions>div:nth-child(" + indice + ")", "ativo");//criar
                }

                if (ind.classList.contains("ativo") && listSingerMusic.length < 5) {//criar
                    checkElementList(listSingerMusic, ind);//criar
                    numberOfSingerMusic++;//criar
                    listSingerMusic.push(ind.dataset.value);//criar
                }

                if (!ind.classList.contains("ativo")) {//criar
                    checkElementList(listSingerMusic, ind);//criar
                    numberOfSingerMusic--;//criar
                }
                let artistas_musica = document.querySelector("#artistas_musica");//criar
                artistas_musica.value = listSingerMusic;//criar
                qnt_artista_musica.value = numberOfSingerMusic;//criar
        
            } else if(elementTableQuery == "EditAlbumSinger"){

                editColetionElement(coletionSingerList,ind,num,"ativo","#singerOptions");


            } 
            else if(elementTableQuery == "SetMusicSinger"){
                editColetionElement(coletionSingerList,ind,num,"ativo","#singerOptions");
                let artistas_musica = document.querySelector("#artistas_musica");//criar
                artistas_musica.value = coletionSingerList;
            }



            // choiceElement(singers, num, singers[num], "ativo");
            singerOfAlbum = listSingerAlbum;//so para o album
            singerOfMusic = listSingerMusic;//so para o album
        })
    })
}
singersClick();

let numberOfMusic = 0;
let listMusic = [];
const musicsClick = () => {

    const musics = document.querySelectorAll("#musicOptions > div");
    musics.forEach((ind, num) => {
        ind.addEventListener('click', () => {

            let indice = num + 1;

            if(elementTableQuery == "CreateAlbumMusic"){

            toggleElement("#musicOptions>div:nth-child(" + indice + ")", "ativo");
            checkElementList(listMusic, ind);
            if (ind.classList.contains("ativo")) {//criar
                numberOfMusic++;//criar
                listMusic.push(ind.dataset.value);//criar
            } else {
                let cancel = listMusic.indexOf(ind.dataset.value);
                listMusic.splice(cancel, 1);
                numberOfMusic--;//criar
            }
            let musicas = document.querySelector("#musicas");//criar
            musicas.value = listMusic;//criar
            qnt_musica.value = numberOfMusic;//criar

        } else if(elementTableQuery == "EditAlbumMusic"){//editar

            editColetionElement(coletionMusicList,ind,num,"ativo","#musicOptions");

        } else if( elementTableQuery == "SetMusicSinger"){

            editColetionElement(singerMusicList,ind,num,"ativo","#musicOptions");

        }


        })
    })
}
musicsClick();



let numberOfCategories = 0;
let categoryLimit = 0;
let listCategory = [];

let qnt_categoria = document.querySelector("#qnt_categoria");


const categoryClick = () => {

    const categories = document.querySelectorAll("#categoryOptions > div");

    categories.forEach((ind, num) => {
        ind.addEventListener('click', () => {
            let indice = num + 1;

            if(listCategory.length < 5 && !ind.classList.contains("ativo")){
            addElement("#categoryOptions>div:nth-child(" + indice + ")", "ativo");
            } else if(listCategory.length <= 5 && ind.classList.contains("ativo")){
            removeElement("#categoryOptions>div:nth-child(" + indice + ")", "ativo");
            }

            if (elementTableQuery == "CreateAlbumCategory") {

                if (ind.classList.contains("ativo") && listCategory.length < 5) {
                    checkElementList(listCategory, ind);
                    numberOfCategories++;
                    listCategory.push(ind.dataset.value);
                }

                if (!ind.classList.contains("ativo")) {
                    checkElementList(listCategory, ind);
                    numberOfCategories--;
                }

                let categorias = document.querySelector("#categorias");
                categorias.value = listCategory;
                qnt_categoria.value = numberOfCategories;
                categoryOfAlbum = listCategory;
            } else if (elementTableQuery == "CreateMusicCategory") {
                categoryOfMusic = indice;
                choiceElement(categories, num, categories[num], "ativo");
                setElement(ind, "#fk_categoriaMusica", "ativo");
            } else if(elementTableQuery == "EditAlbumCategory"){
                editColetionElement(coletionCategoryList,ind,num,"ativo","#categoryOptions");
            }
            // let categorias = document.querySelector("#musicas");
            // categories.value = listMusic;
            // qnt_categories.value = numberOfCategories;
            
        })
    })
}
categoryClick();


let listAlbum = [];



const albumClick = () => {

    const albuns = document.querySelectorAll("#albumOptions > div");

    albuns.forEach((ind, num) => {
        ind.addEventListener('click', () => {
            let indice = num + 1;

            

            
            if (elementTableQuery == "CreateSingerColetion") {
                editColetionElement(singerAlbumList,ind,num,"ativo","#albumOptions");
            } else if(elementTableQuery == "CreateMusicColetion"){
                editColetionElement(musicAlbumList,ind,num,"ativo","#albumOptions");
            }

             
            // let categorias = document.querySelector("#musicas");
            // categories.value = listMusic;
            // qnt_categories.value = numberOfCategories;
        })
    })
}
albumClick();


window.deleteColetionElement = deleteColetionElement;
window.searchElement = searchElement;
window.elementRegisterScreen = elementRegisterScreen;
window.elementRegisterAction = elementRegisterAction;
window.elementChoiceScreen = elementChoiceScreen;
window.searchType = searchType;
window.elementViewScreen = elementViewScreen;
