<!DOCTYPE html>
<!--[if lt IE 7]> <html class="lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]> <html class="lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]> <html class="lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="en"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>IBANet - Autenticação</title>
        <script src="{$host}public/javascript/jquery.min.js"></script>
        <script>
            /*
             * To change this license header, choose License Headers in Project Properties.
             * To change this template file, choose Tools | Templates
             * and open the template in the editor.
             */

            $(document).ready(function() {
                $("#form_login").submit(function() {

                    if (confirm("Deseja Continuar?")) {

                        if ($("#psa_pwd").val() == "") {
                            alert("Por favor informe a senha!");
                            $("#psa_pwd").focus();
                            return false;
                        }

                        if ($("#psa_pwd2").val() == "") {
                            alert("Por favor confirme a senha!");
                            $("#psa_pwd2").focus();
                            return false;
                        }

                        if ($("#psa_pwd").val() != $("#psa_pwd2").val()) {
                            alert("As senha informadas não conferem!");
                            $("#psa_pwd").val("");
                            $("#psa_pwd2").val("");
                            $("#psa_pwd").focus();
                            return false;
                        }

                        $("#formulario").hide();
                        $("#carregando").show();

                        return true;
                    } else {
                        return false;
                    }
                });
            });
        </script>
        <script type="text/javascript" src="https://www.google.com/recaptcha/api.js?hl=pt"></script>
        <link rel="stylesheet" href="{$host}public/css/login.css">
        <!--[if lt IE 9]><script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
    </head>
    <body>
        <div id="formulario" style="display: block;">
            <form id="form_login" method="post" action="{$host}Login/setPasswordUser/" class="login">
                <input type="hidden" value="{$psa_cod}" name="psa_cod">
                <table class="table" width="100%" border="0" cellpadding="5">
                    <tr>
                        <td colspan="2">
                            <section class="about">
                                <p class="about-links">
                                    <img src="{$host}public/image/logo.png">
                                </p>
                                <p class="about-author">
                                    &copy; 2012&ndash;2015 Criare Development<br>Todos os Direitos Reservados
                                </p>
                            </section>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" class="label">
                            <section class="td">
                                <h3>Olá, é você mesmo?</h3> <h2>{$nome}</h2>
                                <h4>
                                    Se for, informe a sua senha para acessar o IBANet. Você deve informar a senha e repeti-la para confirmar e em seguida, marcar "<b>Não sou um robô</b>" e clicar na seta.
                                </h4>
                            </section>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <section class="td">
                            Senha:<br>
                            <input type="password" name="psa_pwd" id="psa_pwd" value="">
                            </section>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <section class="td">
                            Confirme a Senha:<br>
                            <input type="password" name="psa_pwd2" id="psa_pwd2" value="">
                            </section>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <section class="td">
                            <div class="g-recaptcha" data-sitekey="6LeruwMTAAAAAGv0tqeK9EpbjSJHWv2J6d9IdyWF"></div>
                            </section>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <section class="td">
                            <button type="submit" class="login-button"></button>
                            </section>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
        <div id="carregando" class="carregando" style="display: none;">
            <img src="{$host}public/image/ajax-loader.gif">
        </div>
    </body>
</html>