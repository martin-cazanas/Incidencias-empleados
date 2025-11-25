function logout(){
    window.alert("Se cerro sesión exitosamente");
    redirectHome();
}
function redirectHome(){
    location.href = "./";
}
function actions(){
    let select = document.getElementById("action");
    let ins = document.getElementById("insert");
    let man = document.getElementById("manage");
    let nada = document.getElementById("nada");
    if(select.value == "insert"){
        ins.hidden = false;
        man.hidden = true;
        nada.hidden = true;
    }
    else if(select.value == "manage"){
        man.hidden = false;
        ins.hidden = true;
        nada.hidden = true;
    }
    else if(select.value == "nada"){
        man.hidden = true;
        ins.hidden = true;
        nada.hidden = false;
    }
}
function manageActions(radio){
    let select = document.getElementById("manageAction");
    if(radio.checked == true){
        select.removeAttribute("disabled");
        let button = radio.id;
        let tdel = document.getElementById("tipo_del"), cdel = document.getElementById("clave_del"), fdel = document.getElementById("fecha_del"); //inputs tipo hidden
        let htup = document.getElementById("htup"), hcup = document.getElementById("hcup"), hfup = document.getElementById("hfup"), hsup = document.getElementById("hsup");
        let ccel = document.getElementById("clave" + button), tcel = document.getElementById("tipo" + button), fcel = document.getElementById("fecha" + button), scel = document.getElementById("estat" + button); //celdas
        let tup = document.getElementById("tipo_edit"), cup = document.getElementById("clave_edit"), fup = document.getElementById("fecha_edit"), sup = document.getElementById("stat_edit");
        cdel.value = ccel.innerHTML.substring(0, 6);
        cup.value = ccel.innerHTML.substring(0, 6);
        hcup.value = ccel.innerHTML.substring(0, 6);
        if(tcel.innerHTML == "Retardo Menor"){
            tdel.value = "N";
            tup.value = "N";
            htup.value = "N";
        }else if(tcel.innerHTML == "Retardo Mayor"){
            tdel.value = "Y";
            tup.value = "Y";
            htup.value = "Y";
        }else if(tcel.innerHTML == "Falta por llegar tarde"){
            tdel.value = "L";
            tup.value = "L";
            htup.value = "L";
        }else if(tcel.innerHTML == "Falta por salida anticipada"){
            tdel.value = "A";
            tup.value = "A";
            htup.value = "A";
        }else if(tcel.innerHTML == "Falta por omisión de salida"){
            tdel.value = "O";
            tup.value = "O";
            htup.value = "O";
        }else if(tcel.innerHTML == "Falta por todo el día"){
            tdel.value = "D";
            tup.value = "D";
            htup.value = "D";
        }
        fdel.value = fcel.innerHTML;
        fup.value = fcel.innerHTML;
        hfup.value = fcel.innerHTML;
        if(scel.innerHTML == "Activo"){
            sup.value = "A";
            hsup.value = "A";
        }
        else if(scel.innerHTML == "Baja"){
            sup.value = "B";
            hsup.value = "B";
        }
    }
}
function manageTasks(select){
    let update = document.getElementById("edit");
    let del = document.getElementById("delete");
    let none = document.getElementById("nada");
    if(select.value == "nada"){
        none.hidden = false;
        update.hidden = true;
        del.hidden = true;
    } else if(select.value == "update"){
        update.hidden = false;
        none.hidden = true;
        del.hidden = true;
    }else if(select.value == "delete"){
        del.hidden = false;
        update.hidden = true;
        none.hidden = true;
    }
}