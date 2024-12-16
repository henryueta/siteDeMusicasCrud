const data_usuario = document.querySelector("#data");

        const newDate = new Date();

        let gapMonth = newDate.getMonth().toString().length == 1 ? "-0" : "-";
        let gapDay = newDate.getDate().toString().length == 1 ? "-0" : "-";

        data_usuario.value = newDate.getFullYear() +gapMonth+(newDate.getMonth()+1)+gapDay+newDate.getDate();