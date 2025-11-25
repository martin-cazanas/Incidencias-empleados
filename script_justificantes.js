function logout(){
    window.alert("Se cerro sesión exitosamente");
    redirectHome();
}
function redirectHome(){
    location.href = "./";
}
function loadDates(){
    let clave = document.getElementById("clave");
    if(clave.value != "nada"){
        let xhhtp = new XMLHttpRequest();
        xhhtp.onreadystatechange = function() {
            if(xhhtp.readyState == 4 && xhhtp.status == 200){
                document.getElementById("fecha").innerHTML = "<option value='nada'>--Seleccionar</option>" + xhhtp.responseText;
            }
        }
        xhhtp.open("POST", "loadFechajust.php", true);
        xhhtp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhhtp.send("clave="+clave.value);
    }else{
        document.getElementById("fecha").innerHTML = "<option value='nada'>--Seleccionar</option>";
    }
}
function confirmado(){
    let confirm = document.getElementById("confirm");
    confirm.value = "si";
}
function denegado(){
    let confirm = document.getElementById("confirm");
    confirm.value = "no";
}
function manageActions(radio){
    let edit = document.getElementById("update");
    let del = document.getElementById("delete");
    if(radio.checked == true){
        edit.removeAttribute("disabled");
        del.removeAttribute("disabled");
    }
}