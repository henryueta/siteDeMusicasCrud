import { elementQuery, setFormData, setArrayData } from "../../module/scripts/module";

let showPass = false;
let displayPass = "none";
let btnPasswordText = "Redefinir Senha";
export const editPass = ()=>{

    showPass = !showPass;
    if(showPass){
        displayPass = "flex";
        btnPasswordText = "Cancelar";
    } else{
        displayPass = "none";
        btnPasswordText = "Redefinir Senha";
        document.querySelector("#senha").value = "";
    }
    return ()=>{
        document.querySelector(".btnEditPassword").textContent = btnPasswordText;
        document.querySelector("#senha").style.display= displayPass;
    }

}

export const setFormDataElement = (data, name) => {
    setArrayData(dataArray, data);
    setArrayData(nameArray, name)
}

const userInfo = new FormData();
const adminInfo = new FormData();

let dataArray = [];
let nameArray = [];
let queryType;
let queryUrl;
let formType;
let responseType;

const profileResponse = {

"UserResponse":(res)=>{
},
"AdminResponse":(res)=>{

}

}

export const setDateProfile = (profileType, registerType) => {

    setFormDataElement([
        document.querySelector("#nome").value,
        document.querySelector("#email").value,
        document.querySelector("#senha").value
    ],
    [
        "nome",
        "email",
        "senha"
    ]);
    const checkRegisterType = {

        "create": () => {
            queryType = "post";
            if(profileType == "user"){
            queryUrl = "";
            } else if(profileType == "admin"){
            queryUrl = "../../admin/create/createAdmin.act.php";
            }
        },
        "edit": () => {
            queryType = "post";
            if(profileType == "user"){
            queryUrl = "../../user/edit/editUser.act.php";
            } else if(profileType == "admin"){
            queryUrl = "../../admin/edit/editAdmin.act.php";
            }
            setFormDataElement([
                document.querySelector("#senhaAntiga").value,
                document.querySelector("#id").value,
            ],
            [
                "senhaAntiga",
                "id",
            ]);
        }

    }
    checkRegisterType[registerType]()

    const checkProfileType = {

        "user": () => {
            formType = userInfo;
            responseType = "UserResponse";
            setFormDataElement([
                document.querySelector("#foto").value,
            ],
            [
                "foto",
            ]);

            if (registerType == "edit") {

                setFormDataElement([
                    document.querySelector("#fotoAntiga").value,
                ],
                [
                    "fotoAntiga",
                ]);
            }
        },
        "admin": () => {
                formType = adminInfo;
                responseType = "AdminResponse";       
                setFormDataElement([
                    document.querySelector("#tipo").value,
                ],
                [
                    "tipo",
                ]);

        }

    }
    checkProfileType[profileType]();


    setFormData(formType,
        dataArray, nameArray
    )

    elementQuery(queryType,queryUrl,formType,profileResponse,responseType,'html');

}

window.setDateProfile = setDateProfile;
window.editPass = editPass;
