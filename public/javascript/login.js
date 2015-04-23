/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$(document).ready(function() {
    $("#form_login").submit(function() {
        var dados = jQuery(this).serialize();

        if ($("#psa_email").val() == "") {
            alert("Por favor informe seu email!");
            $("#psa_email").focus();
            return false;
        }

        if ($("#psa_pwd").val() == "") {
            alert("Por favor informe sua senha!");
            $("#psa_pwd").focus();
            return false;
        }

        $("#formulario").hide();
        $("#carregando").show();

        jQuery.ajax({
            type: "POST",
            url: "http://" + location.host + "/IBANet/Login/Authentic/",
            data: dados,
            dataType: "json",
            success: function(data)
            {
                if(data == '1'){
                    $(location).attr('href', 'http://' + location.host + '/IBANet/Index');
                }else{
                    alert(data);
                    $("#carregando").hide();
                    $("#formulario").show();
                }
            }
        });
        return false;
    });
});