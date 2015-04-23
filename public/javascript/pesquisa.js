var time = 0;
var control = 0;
var divContent = 0;
var idCampo = null;
var idRetorno = null;
var idHidden = null;
function ajax(id, href, idResult) {
    idCampo = id;
    idRetorno = idResult;
    idHidden = id+"Hidden";
    var letras = $("#" + id).val().length;
    var data = $("#" + id).val().toUpperCase();
    if ((letras >= 3) === true) {
        var funcClick = setDivEvent;
        /*
        if(control === 1){
            divContent = $("#" + idResult).children();
        }
        */
        var numElemt = divContent.length;

        if((numElemt>0) === true && (letras > 6) === true){
            var check = 0;
            var pesquisa = null;
            var content = null;
            var cod = 0;
            $("#" + idResult).text("");

            for(var j=0; j<numElemt; j++){

                content = divContent[j].value.toUpperCase();
                cod = divContent[j].id;
                pesquisa = content.search(data);
                if( (pesquisa >= 0) === true){
                    $("#"+idResult).append("<div id='"+divContent[j].id+"' class='div_hover'>"+content.replace(data,"<b>"+data+"</b>")+"</div>");
                    $("#"+divContent[j].id).click(funcClick);
                }else{
                    check = check + pesquisa;
                }
            }

            var soma = numElemt + (check);
            if(soma === 0){
                $("#"+idResult).append("<div>NENHUM RESULTADO ENCONTRADO</div>");
            }

            control = 0;
            return;
        }


        //Requisição Ajax
        jQuery.ajax({
            type: "post",
            data: "data=" + data,
            url: href, //URL de destino
            dataType: "json", //Tipo de Retorno
            success: function(json) { //Se ocorrer tudo certo
                $("#" + idResult).text("");
                var x = json.length;
                for (var i = 0; i < x; i++) {
                    //alert(json[i].search(data));

                    $("#"+idResult).append("<div id='"+json[i].id+"' class='div_hover'>"+json[i].value.toUpperCase().replace(data,"<b>"+data+"</b>")+"</div>");
                    if(json[i].value.toUpperCase() !== "NENHUM RESULTADO ENCONTRADO"){
                        $("#"+json[i].id).click(funcClick);
                    }
                }
                divContent = json;
                control = 0;
            }
        });
    } else if ((letras <= 2) === true) {
        $("#" + idResult).text(data);
        $("#" + idHidden).val("");
    }

    if((letras<=0) === true){
        $("#"+idResult).hide();
    }else{
        $("#"+idResult).show();
    }
}

function pesquisa(id, href, idResult) {
    clearTimeout(time);
    time = setTimeout(ajax, 250, id, href, idResult);
}

function setDivEvent(){
    $("#"+idCampo).val($("#"+this.getAttribute("id")).text());
    $("#"+idRetorno).hide();
    $("#"+idHidden).val(this.getAttribute("id"));
}