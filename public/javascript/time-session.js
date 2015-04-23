/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


var intervalo = setInterval(sessao, 5000);
function sessao() {
    //Requisição Ajax
    jQuery.ajax({
        type: "post",
        data: null,
        url: "http://" + location.hostname + "/IBANet/Login/Sessao", //URL de destino
        dataType: "json", //Tipo de Retorno
        success: function(json) { //Se ocorrer tudo certo
            $("#horas").text("Sessão: " + json[0]);

            if((json[1] <= 5) === true){
                window.location = "http://" + location.hostname + "/IBANet/Logout";
            }

            if((json[1] <= 120) === true){
                clearInterval(intervalo);
                if(confirm("Deseja renovar a sessão?")){
                    renovaSessao();
                }else{
                    window.location = "http://" + location.hostname + "/IBANet/Logout";
                }
            }
        }
    });
}

function renovaSessao() {
    //Requisição Ajax
    jQuery.ajax({
        type: "post",
        data: null,
        url: "http://" + location.hostname + "/IBANet/Login/RenovaSessao", //URL de destino
        dataType: "json", //Tipo de Retorno
        success: function(json) { //Se ocorrer tudo certo
            $("#horas").text("Sessão: " + json[0]);

            intervalo = setInterval(sessao, 5000);
        }
    });
}