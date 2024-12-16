
export const diasSemana = ['domingo', 'segunda', 'terça', 'quarta', 'quinta', 'sexta', 'sábado'];

export const tableTypeConstructor = (type)=>{

    getGraphicInfo(type);


}

const ctx = document.querySelector('#userGraphic');

const elementGraphicInfo = new FormData();

const data = new Date();
let dia = data.getDate() - data.getDay();
let mes = data.getMonth()
let gapDay = "-";
let gapMonth = "-";
const createGap = (string, gap) => {
    if (string.length == 1) {
        gap = "-0";
    } else {
        gap = "-";
    }
    return gap;
}
let ultimoDia;
let primeiroDia;
let array = [];
for (let i = 0; i < 7; i++) {
    let diaSemana = new Date();
    diaSemana.setMonth(mes)
    diaSemana.setDate(dia + i);

    gapMonth = createGap(diaSemana.getMonth().toString(), gapMonth);
    gapDay = createGap(diaSemana.getDate().toString(), gapDay);

    let element = diaSemana.getFullYear() + gapMonth + (diaSemana.getMonth() + 1) + gapDay + diaSemana.getDate();
    if (i == 0) {
        primeiroDia = element;
    }
    if (i == 6) {
        ultimoDia = element;
    }
    array.push(element);
}
elementGraphicInfo.set("primeiroDia", primeiroDia);
elementGraphicInfo.set("ultimoDia", ultimoDia);


let graphicInfoResponse = [];
let graphicInfoChecked = [];
let total = 0;
function getGraphicInfo(table) {
    elementGraphicInfo.set("table",table);
    $.ajax({

        type: "post",
        data: elementGraphicInfo,
        contentType: false,
        processData: false,
        datatype: "json",
        url: "../../module/structure/createGraphic.act.php",
        success: (res) => {

            total = JSON.parse(res)[JSON.parse(res).length - 1].total;
            
            JSON.parse(res).forEach((ind, num) => {
                graphicInfoResponse.push(ind.dia);
            })
            for (let i = 0; i < 7; i++) {
                if (graphicInfoResponse.includes(array[i])) {

                    const ind = JSON.parse(res).find(item => item.dia === array[i]);
        
                    if (ind) {
                        graphicInfoChecked.push(ind.new_register);
                    } else {
                        graphicInfoChecked.push(0);
            
                    }                          
                } else{
                    graphicInfoChecked.push(0)
                }
            }
            desenhar();
        }
    })


}

function desenhar() {
    new Chart(ctx, {
        type: "line",
        data: {
            labels: diasSemana,
            datasets: [{
                label: "Crescimento de usuários no site",
                data: graphicInfoChecked,
                borderWidth: 1,
                backgroundColor: "rgb(255, 0, 221)",
                borderColor: "rgb(255, 0, 221)"
            }]
        },
    })
}

