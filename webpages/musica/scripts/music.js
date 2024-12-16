
import {
    toggleElement,
    removeElement,
    setImg,
    choiceElement
} from "../../module/scripts/module.js";

let musicSourceInfo =  document.querySelectorAll(".music-info>audio");

const musicList = [];

musicSourceInfo.forEach((ind)=>{
    musicList.push(ind);
})

let playAlbum = document.querySelector(".play-album");

export let ativado = true;

export const elementConstructor = (cond) =>{
    return ativado = cond;
}



export const playlistEditScreen = document.querySelector(".playlistEditScreen");

export let musicDeleteList = [];
export let musicNodeList = [];
export const musicCount = document.querySelector("#musicCount");

export const viewPlaylistEditScreen = (display)=>{
    playlistEditScreen.style.display = display;
    musicDeleteList.length = 0;
    musicNodeList.length = 0;
}



export const musicEditOptions = (background,letter,index)=>{
    musicCount.textContent = musicDeleteList.length;

    document.querySelector(".music-num>div:nth-child("+index+")").style.backgroundColor = background;
    document.querySelector(".music-num>div:nth-child("+index+")").style.color = letter;
}


export const resetEditOptions = (type)=>{
let music_num = document.querySelectorAll(".music-num>div:not(#titulo-faixas)");
    music_num.forEach((ind, num) => {
        let indice = num + 2;
        alert("AAAAAAA")
     removeElement(".music-num>div:nth-child(" + indice + ")", "ativo"); 
         musicEditOptions("rgb(204, 204, 204)", "black", num + 2);
     })
}

let musicNum = document.querySelector(".music-num");

export let musicId;
export const musicAlbumClick = ()=>{

    // let click = document.querySelectorAll(".music-num .music-cape");
    let music_num = document.querySelectorAll(".music-num>div:not(#titulo-faixas)");
    let letterColor;
    let backgroundColor;
    let editDisplay;

    music_num.forEach((ind, num) => {

                    ind.addEventListener('click', () => {
                        let indice = num + 2;
                        toggleElement(".music-num>div:nth-child(" + indice + ")", "ativo");
                        choiceElement(music_num, num,"ativo");
                        
                            if(ativado){
                                

                                let pause = "../../../imgs/website/pause.png";
                                let play = "../../../imgs/website/play.png";
                                getMusic(".music-num>div:nth-child(" + indice + ")>audio",".music-num>div:nth-child(" + indice + ")");
                                getImage(".music-num>div:nth-child(" + indice + ")>.music-cape>img");
                                getText(".music-num>div:nth-child(" + indice + ")>.music-name>h1",
                                    ".music-num>div:nth-child(" + indice + ")>.music-name>p");
                                    
                            } else{
                             if(document.querySelector(".music-num>div:nth-child(" + indice + ")").classList.contains("ativo")){
                                backgroundColor = "rgb(25, 25, 26)";
                                letterColor = "white";
                                editDisplay = "flex";
                                musicDeleteList.unshift(document.querySelector(".music-num>div:nth-child(" + indice + ")").dataset.value);
                                musicNodeList.unshift(document.querySelector(".music-num>div:nth-child(" + indice + ")"));
                             } else{
                                backgroundColor = "rgb(204, 204, 204)";
                                letterColor = "black";
                                editDisplay = "none";
                                musicDeleteList.splice(musicDeleteList.indexOf(document.querySelector(".music-num>div:nth-child(" + indice + ")").dataset.value,1));
                                musicNodeList.splice(musicNodeList.indexOf(document.querySelector(".music-num>div:nth-child(" + indice + ")"),1));
                             }
                            }

                            musicEditOptions(backgroundColor,letterColor,indice);      
                    });
                
                
                
            })
        }
musicAlbumClick();
    
export const deleteMusicBtn = document.querySelector(".music-edit>button");

    // deleteMusicBtn.addEventListener('click', () => {

        
    // musicNodeList.forEach((ind,num)=>{
    //     musicNum.removeChild(ind);
    // })

    // })

export function getElement(element){
    return element;
}

// const albumTypeDiv = document.querySelectorAll(".albumType>div");

// albumTypeDiv.forEach((ind)=>{
//     ind.addEventListener('mouseover',()=>{
//     })
// })

const barAtual = document.querySelector(".bar");
const musicCapeIcon = document.querySelector(".musicCapeIcon");
const musicTitle = document.querySelector(".musicTitle");
const musicSinger = document.querySelector(".musicSinger");
const playMusicBtn = document.querySelector(".playMusicBtn");
const volume = document.querySelector(".volume");


function setMusic(music) {
    cond = true;
    playMusic = false;
    musicAction();
    document.querySelectorAll("audio").forEach(ind => ind.pause())
    music.currentTime = 0;
    music.play();
    setMusicBarLocation();
}

export let musica;
let musicIndex;
let index;

function getMusic(identity,id) {
    musica = document.querySelector(identity);
    musicId = document.querySelector(id).dataset.value;
    musica.volume = 0.5;
    volume.value = 0.5;
    setMusic(musica)
}

let image;
function getImage(source) {
    image = document.querySelector(source);
    musicCapeIcon.src = image.src;
}

function nextMusic(music){
    let music_num = document.querySelectorAll(".music-num>div:not(#titulo-faixas)");

    getMusic(".music-num>div:nth-child(" + music + ")>audio",".music-num>div:nth-child(" + music + ")");
    getImage(".music-num>div:nth-child(" + music + ")>.music-cape>img");
        getText(".music-num>div:nth-child(" + music + ")>.music-name>h1",
            ".music-num>div:nth-child(" + music + ")>.music-name>p");
            toggleElement(".music-num>div:nth-child(" + music + ")", "ativo");
        choiceElement(music_num, music-2, "ativo");
}




let title;
let artist;
function getText(text1, text2) {
    title = document.querySelector(text1);
    artist = document.querySelector(text2);
    musicTitle.textContent = title.textContent;
    musicSinger.textContent = artist.textContent;
}

function setMusicMoment() {
    let duracao = musica.duration;
    musica.currentTime = barAtual.value * duracao / 100;
}

volume.addEventListener('click', () => {
    musica.volume = volume.value;
})


let playMusic = false;
let cond = true;

function musicAction() {

    cond = !cond;

    if (cond) {
        setImg(playMusicBtn, "../../../imgs/website/play2.png");
    } else {
        setImg(playMusicBtn, "../../../imgs/website/pause.png");
    }
    if (!playMusic && !cond) {
        play();
    } else {
        pause();
    }
}
let musicTimer = null;

function play() {
    if (musicTimer != null) {
        clearInterval(musicTimer);
    }
    playMusic = true;
    musica.play();

    musica.addEventListener('timeupdate', () => {
        setMusicBarLocation();

    })
}


function setMusicBarLocation() {

    let duracao = musica.duration;
    let atual = musica.currentTime;
    let audioBar = atual * 100 / duracao;

    
    barAtual.value = audioBar;
}



export function pause() {
    playMusic = false;
    musica.pause();
    clearInterval(musicTimer);
}



const musicAfter = document.querySelector(".musicAfter");
musicAfter.addEventListener('click',()=>{
    musicIndex = musicList.find(ind=> ind === musica);
    index = musicList.indexOf(musicIndex)+3;
    if(index <= musicList.length+1){
        nextMusic(index);
    } 
})


const musicBefore =document.querySelector(".musicBefore");
musicBefore.addEventListener('click',()=>{
    musicIndex = musicList.find(ind=> ind === musica);
    
    index = musicList.indexOf(musicIndex)+1;
    if(index > 1){
        nextMusic(index);
    }
})


window.musicAction = musicAction;
window.setMusicMoment = setMusicMoment;
window.nextMusic = nextMusic;

